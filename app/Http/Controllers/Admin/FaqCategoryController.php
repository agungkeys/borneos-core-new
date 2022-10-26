<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
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
}
