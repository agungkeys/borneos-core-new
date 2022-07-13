<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderAdminRequest extends FormRequest
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
            'customer_name'        => 'required',
            'customer_telp'        => 'required|numeric',
            'customer_address'     => 'required',
            'merchant'             => 'required',
            'order_type'           => 'required',
            'distance'             => 'required',
            'total_item'           => 'required|numeric',
            'latitude'             => 'required',
            'longitude'            => 'required',
            'total_distance_price' => 'required|numeric',
            'total_item_price'     => 'required|numeric',
            'total_price'          => 'required|numeric',
            'payment_total'        => 'required|numeric'
        ];
    }
}
