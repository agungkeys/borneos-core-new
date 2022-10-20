<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCourierRequest extends FormRequest
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
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'address' => 'sometimes',
            'email' => 'email|sometimes',
            'password' => 'sometimes',
            'identity_type' => 'sometimes',
            'identity_no' => 'sometimes',
            'identity_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'profile_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'badge' => 'sometimes',
            'join_date' => 'date|sometimes'
        ];
    }
}
