<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{FormatMeta,Merchants,merchantGroups};
use Illuminate\Http\Request;

class MerchantGroupController extends Controller
{
    use merchantGroups,Merchants, FormatMeta;

    public function get_merchant_groups(Request $request)
    {
        $status = $request->status ?? 1;
        $sort = $request->sort ?? 'desc';
        $perPage = $request->perPage ?? 10;
        $slug = $request->merchantGroups ?? 'all';
        
        $query = $this->queryListMerchantGroup(compact('status','sort','perPage','slug'));

        if($query->count() == 0){
            return response()->json(['status'=>'error','meta'=>(object)[],'data'=>null]);
        } else {
            $meta = $this->MetaMerchantGroupList([
                'page' => $request->page ?? null,
                'perPage'=> $perPage,
                'merchantGroupCount' => $query->total()
            ]);
            return response()->json(['status'=>'success','meta' => $meta,'data' => $this->resultMerchantGroupList(['results'=> $query,'slug' => $slug,'perPage' => $perPage,'sort' => $sort])]);
        }
    }
}
