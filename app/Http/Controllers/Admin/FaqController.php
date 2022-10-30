<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Merchant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function faq_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $faqs = Faq::sortable()
            ->where('faqs.title', 'like', '%'. $filter . '%')
            ->orWhereHas('category', function ($q) use ($filter) {
                return $q->where('title', 'like', "%{$filter}%");
            })
            ->paginate(10);
        } else {
            $faqs = Faq::sortable()->paginate(10);
        }
        return view('admin.faq.index', compact('faqs', 'filter'));
    }

    public function faq_status(Request $request){
        $faq = Faq::withoutGlobalScopes()->find($request->id);

        $faq->status = $request->status;
        $faq->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.faq');
    }

    public function faq_create()
    {
        return view('admin.faq.add', [
            'merchants' => Merchant::all(),
            'faqCategories' => FaqCategory::all(),
        ]);
    }

    public function faq_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/faq", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url = $image->getSecurePath();
        } else {
            $image_url = '';
        };

        $faq = new Faq();
        $faq->merchant_id = 0;
        $faq->category_faq_id = $request->category ?? null;
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->image = $image_url;
        $faq->position = $request->position;
        $faq->type = $request->type;
        $faq->status = 1;

        $faq->save();
        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('admin.faq');
    }

    public function faq_edit($id)
    {
        return view('admin.faq.edit', [
            'faq' => Faq::findOrFail($id),
            'merchants' => Merchant::all(),
            'faqCategories' => FaqCategory::all()
        ]);
    }

    public function faq_update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $faq = Faq::findOrFail($id);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/faq", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url = $image->getSecurePath();
        } else {
            $image_url = $faq->image;
        };

        $faq->merchant_id = $faq->merchant_id;
        $faq->category_faq_id = $request->category ?? $faq->category_faq_id;
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->image = $image_url;
        $faq->position = $request->position;
        $faq->type = $request->type;
        $faq->status = 1;

        $faq->save();
        Alert::success('Success', 'Data updated successfully');
        return redirect()->route('admin.faq');
    }

    public function faq_delete($id){
        $faq = Faq::findOrFail($id);

        $faq->delete();
        return response()->json(['status' => 200]);
    }
}
