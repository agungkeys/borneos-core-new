<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function master_product_index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function master_product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        return redirect('/admin/master-product')->with('toast_success', 'Status Updated');
    }
}
