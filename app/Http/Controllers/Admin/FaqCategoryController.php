<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqCategoryController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)){
            $faq_categories = FaqCategory::sortable()
            ->where('category_faq.title', 'like', '%'. $filter . '%')
            ->orWhere('category_faq.description', 'like', '%'. $filter . '%')
            ->latest()
            ->paginate(10);
        } else {
            $faq_categories = FaqCategory::sortable()->latest()->paginate(10);
        }
        return view('admin.faq-category.index', compact('faq_categories', 'filter'));
    }
    public function create()
    {
        return view('admin.faq-category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'sometimes',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/faq_category']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };
        FaqCategory::create([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('admin.faq-category');
    }
    public function edit($id)
    {
        return view('admin.faq-category.edit',[
            'faq' => FaqCategory::findOrFail($id)
        ]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'sometimes',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $faqCategory = FaqCategory::findOrFail($id);
        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/faq_category',
                'collection' => $faqCategory
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }
        $faqCategory->update([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success('Success', 'Data updated successfully');
        return redirect()->route('admin.faq-category');
    }
}
