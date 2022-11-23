<?php

namespace App\Http\Traits;

use App\Models\Merchant;
use App\Models\MerchantGroup;

trait merchantGroups
{
    public function queryListMerchantGroup($data)
    {
        if($data['slug'] == 'all'){
            $query = MerchantGroup::orderBy('id',$data['sort'])->paginate($data['perPage']);
            return $query;
        } else {
            $query = Merchant::whereHas('merchantGroup', function ($q) use ($data) {
                return $q->where([['slug',$data['slug']],['status',$data['status']]]);
            })->orderBy('id', $data['sort'])->paginate($data['perPage']);
            return $query;
        }
    }
    public function resultMerchantGroupList($data)
    {
        $slug = $data['slug'];
        $results = $data['results'];

        if($slug == 'all'){
           return $this->convertResultMerchantGroupList($results);
        } else {
            $query = MerchantGroup::where('slug',$data['slug'])->orderBy('id',$data['sort'])->paginate($data['perPage']);
            $arrayMerge = [
                'merchantGroups' => $this->convertResultMerchantGroupList($query),
                'merchant' => $this->get_merchant_list($results)
            ];
            return $arrayMerge;
        }
    }
    public function convertResultMerchantGroupList($data)
    {
        foreach($data as $item)
        {
            $results[] = [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'flatDelivery' => $item->flat_delivery == 1 ? true : false,
                'image' => $item->image ? $item->image : null,
                'additionalImage' => $item->additional_image ? json_decode($item->additional_image) : null
            ];
        }
        return $results;
    }
}