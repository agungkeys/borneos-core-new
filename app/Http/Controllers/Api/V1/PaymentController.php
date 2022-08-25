<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Payments, FormatMeta};
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use FormatMeta, Payments;

    public function get_payments(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $status = $request->status ?? 1;
            $perPage = $request->perPage ?? 10;
            $sort  = $request->sort ?? 'desc';

            $payment = Payment::where('status', '=', $status)->orderBy('id', $sort)->paginate($perPage);
            if ($payment->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $meta = $this->MetaPaymentList([
                    'page'           => $request->page == null ? null : $request->page,
                    'perPage'        => $perPage,
                    'payment_count'  => $payment->total()
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->result_payment_list($payment)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        };
    }
}
