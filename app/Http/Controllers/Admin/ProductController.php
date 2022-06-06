<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function master_product_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
          $products = Product::sortable()
          ->where('products.name', 'like', '%'.$filter.'%')
          ->orWhere('products.price', 'like', '%'.$filter.'%')
          ->paginate(10);
        } else {
          $products = Product::sortable()->paginate(10);
        }
        return view('admin.product.index', compact('products', 'filter'));
    }

    public function master_product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        return redirect('/admin/master-product')->with('toast_success', 'Status Updated');
    }
}
