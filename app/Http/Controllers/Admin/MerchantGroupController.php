<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MerchantGroup;
use Illuminate\Http\Request;

class MerchantGroupController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_merchant_group = MerchantGroup::sortable()
                ->where('merchant-groups.name', 'like', '%' . $filter . '%')
                ->orWhere('merchant-groups.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_merchant_group = MerchantGroup::sortable()->paginate(10);
        }
        return view('admin.merchant-groups.index', compact('master_merchant_group', 'filter'));
    }
}
