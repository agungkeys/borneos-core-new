<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterPaymentRequest;
use App\Http\Traits\CloudinaryImage;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    use CloudinaryImage;

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
    public function master_payment_add()
    {
        return view('admin.payment.add');
    }
    public function master_payment_store(MasterPaymentRequest $request)
    {
        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/bank']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };
        Payment::create([
            'name'             => $request->payment_name,
            'type'             => $request->payment_type,
            'account_name'     => $request->account_name,
            'account_no'       => $request->account_no,
            'image'            => $image_url,
            'additional_image' => $additional_image,
            'status'           => 1
        ]);
        Alert::success("Success", "Created Successfully");
        return redirect()->route('admin.master-payment');
    }
}
