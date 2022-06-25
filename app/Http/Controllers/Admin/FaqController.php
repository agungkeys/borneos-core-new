<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function faq_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $faqs = Faq::sortable()
            ->where('faqs.title', 'like', '%'. $filter . '%')
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
}
