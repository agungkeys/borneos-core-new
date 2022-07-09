<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function master_payment_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $payments = Payment::sortable()
                ->where('payments.id', 'like', '%' . $filter . '%')
                ->orWhere('payments.name', 'like', '%' . $filter . '%')
                ->orWhere('payments.account_name', 'like', '%' . $filter . '%')
                ->orWhere('payments.account_no', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $payments = Payment::sortable()->paginate(10);
        }
        return view('admin.payment.index', compact('payments', 'filter'));
    }
    public function master_payment_status(Request $request)
    {
        $payment = Payment::withoutGlobalScopes()->find($request->id);
        $payment->status = $request->status;
        $payment->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-payment');
    }
}
