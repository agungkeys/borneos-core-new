<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function master_product_index(Request $request)
    {
        $filter = $request->query('filter');
        $merchant_id = auth()->guard('merchant')->user()->id;
        if (!empty($filter)) {
            $products = Product::sortable()
                ->where([['products.name', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant_id]])
                ->orWhere([['products.price', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant_id]])
                ->paginate(10);
        } else {
            $products = Product::sortable()->where('products.merchant_id', '=', $merchant_id)->paginate(10);
        }
        return view('merchant.product.index', compact('products', 'filter'));
    }
    public function master_product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/merchant/master-product');
    }
}
