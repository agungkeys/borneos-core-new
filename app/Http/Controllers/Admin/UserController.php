<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function master_user_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_users = Admin::sortable()
                ->where('admins.f_name', 'like', '%' . $filter . '%')
                ->orWhere('admins.l_name', 'like', '%' . $filter . '%')
                ->orWhere('admins.phone', 'like', '%' . $filter . '%')
                ->orWhere('admins.email', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_users = Admin::sortable()->paginate(10);
        }
        return view('admin.user.index', compact('master_users', 'filter'));
    }
    public function master_user_status(Request $request)
    {
        $product = Admin::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-user');
    }
}
