<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function master_customer_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_customers = User::sortable()
                ->where('users.name', 'like', '%' . $filter . '%')
                ->orWhere('users.email', 'like', '%' . $filter . '%')
                ->orWhere('users.telp', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_customers = User::sortable()->paginate(10);
        }
        return view('admin.customer.index', compact('master_customers', 'filter'));
    }
}