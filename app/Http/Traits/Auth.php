<?php

namespace App\Http\Traits;

use App\Models\User;

trait auth
{
     public function generateTokenPIN()
    {
        do {
            $generate = random_int(100000, 999999);
            $pin_token = $generate;
            $check = User::select('pin_token')->where('pin_token',$pin_token)->first();
        } while (!empty($check));
        return $pin_token;
    }
}