<?php

namespace App\Http\Controllers\APi\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Faq as TraitsFaq,FormatMeta};
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use TraitsFaq, FormatMeta;

    public function get_faqs(Request $request)
    {
        $type = $request->type ?? 'all';
        $sort = $request->sort ?? 'desc';
        $perPage = $request->perPage ?? 10;
        
        $query = $this->queryListFAQ(compact('type','sort','perPage'));
    
        if ($query->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $meta = $this->MetaListFAQ([
                'page'  => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'faq_count' => $query->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultListFAQ($query)]);
        }
    }
}
