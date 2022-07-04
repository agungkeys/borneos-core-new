<?php

namespace App\Http\Traits;

use App\Models\Order;
use Illuminate\Support\Str;

trait Orders
{
    public function countPrefix($prefix)
    {
        return Order::where('prefix', $prefix)->count();
    }
    public function GeneratePrefix()
    {
        $generate = Str::random(20);
        $prefix = $generate;
        if ($this->countPrefix($prefix) > 0) {
            $prefix_2 = $generate;
            if ($this->countPrefix($prefix_2) > 0) {
                $prefix_3 = $generate;
                if ($this->countPrefix($prefix_3) > 0) {
                    $prefix_4 = $generate;
                    if ($this->countPrefix($prefix_4) == 0) {
                        return $prefix_4;
                    }
                } else {
                    return $prefix_3;
                }
            } else {
                return $prefix_2;
            }
        } else {
            return $prefix;
        }
    }
}
