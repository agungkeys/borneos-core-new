<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderType' => 'required',
            'merchantId' => 'required',
            'customerName' => 'required',
            'customerTelp' => 'required|numeric',
            'customerAddress' => 'required',
            'customerAddressLat' => 'required',
            'customerAddressLng' => 'required',
            'distance' => 'required',
            'totalItem' => 'required',
            'paymentType' => 'required',
            'paymentMethod' => 'required',
            'paymentAccountName' => 'required',
            'paymentAccountNumber' => 'required'
        ];
    }
}
