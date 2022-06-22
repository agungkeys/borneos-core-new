<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(Request $request)
    {
      $slug = '';
        return view('admin.orders.index', compact('slug'));
    }

    public function index_slug(Request $request, $slug)
    {
        return view('admin.orders.index', compact('slug'));
    }
}
