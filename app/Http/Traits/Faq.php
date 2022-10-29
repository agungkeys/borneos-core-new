<?php

namespace App\Http\Traits;

use App\Models\Faq as ModelsFAQ;

trait Faq
{
    public function queryListFAQ($data)
    {
        $type = $data['type'];
        $sort = $data['sort'];
        $perPage = $data['perPage'];

        if($type == 'all'){
            $query = ModelsFAQ::where([['status','=',1]])->orderBy('id', $sort)->paginate($perPage);
        }else{
            $query = ModelsFAQ::where([['type','=',$type],['status','=',1]])->orderBy('id', $sort)->paginate($perPage);
        }
        return $query;
    }
    public function resultListFAQ($data)
    {
        foreach($data as $result)
        {
            $results[] = [
                'id' => $result->id,
                'categoryFAQ' => $result->category_faq_id && $result->category ? [
                    'id' => $result->category_faq_id,
                    'title' => $result->category->title,
                    'description' => $result->category->description ? $result->category->description : '',
                    'image' => $result->category->image ? $result->category->image : null,
                    'additionalImage' => $result->category->additional_image ? json_decode($result->category->additional_image) : null
                ] : null,
                'title' => $result->title,
                'description' => $result->description ? $result->description : '',
                'image' => $result->image ? $result->image : '',
                'position' => $result->position,
                'type' => $result->type,
                'status' => $result->status
            ];
        }
        return $results;
    }
}