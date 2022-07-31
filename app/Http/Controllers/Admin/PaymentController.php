<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterPaymentRequest;
use App\Http\Traits\CloudinaryImage;
use App\Models\Payment;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
                ->orWhere('payments.account_type', 'like', '%' . $filter . '%')
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
            'account_type'     => $request->account_type,
            'account_name'     => $request->account_name,
            'account_no'       => $request->account_no,
            'image'            => $image_url,
            'additional_image' => $additional_image,
            'status'           => 1
        ]);
        Alert::success("Success", "Created Successfully");
        return redirect()->route('admin.master-payment');
    }
    public function master_payment_edit(Payment $payment)
    {
        return view('admin.payment.edit', compact('payment'));
    }
    public function master_payment_update(MasterPaymentRequest $request, Payment $payment)
    {
        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/bank',
                'collection' => $payment
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }
        $payment->update([
            'name'             => $request->payment_name,
            'type'             => $request->payment_type,
            'account_type'     => $request->account_type,
            'account_name'     => $request->account_name,
            'account_no'       => $request->account_no,
            'image'            => $image_url ?? $payment->image,
            'additional_image' => $additional_image ?? $payment->additional_image
        ]);
        Alert::success("Success", "Updated Successfully");
        return redirect()->route('admin.master-payment');
    }
    public function master_payment_delete(Payment $payment)
    {
        if (substr($payment->image, 0, 4) == 'http') {
            $key = json_decode($payment->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $payment->delete();
        return response()->json(['status' => 200]);
    }

    public function master_payment_show($id)
    {
        $payment = Payment::where(['id' => $id])->get()[0];
        return response()->json(compact('payment'));
    }
}
