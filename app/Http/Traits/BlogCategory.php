<?php

namespace App\Http\Traits;

trait BlogCategory
{
    public function resultBlogCategory($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id'   => $result->id,
                'name' => $result->name,
                'slug' => $result->slug,
                'image' => $result->image ? $result->image : null,
                'additional_image' => $result->additional_image ? json_decode($result->additional_image) : null
            ];
        }
        return $results;
    }
}
