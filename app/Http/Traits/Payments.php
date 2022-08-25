<?php

namespace App\Http\Traits;


trait Payments
{
    public function result_payment_list($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id' => $result->id,
                'name' => $result->name,
                'type' => $result->type,
                'accountType' => $result->account_type ? $result->account_type : null,
                'accountName' => $result->account_name ? $result->account_name : null,
                'accountNo' => $result->account_no ? $result->account_no : null,
                'image' => $result->image ? $result->image : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'status' => $result->status
            ];
        }
        return $results;
    }
}
