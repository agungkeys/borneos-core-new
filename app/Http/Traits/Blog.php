<?php

namespace App\Http\Traits;

use App\Models\Blog as BlogModel;

trait Blog
{
    public function resultBlogList($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id'   => $result->id,
                'categoryBlog' => [
                    'id' => $result->blog_category_id,
                    'name' => $result->blog_category_id && $result->blog_category->name ? $result->blog_category->name : null,
                    'slug' => $result->blog_category_id && $result->blog_category->slug ? $result->blog_category->slug : null,
                ],
                'title' => $result->title,
                'slug' => $result->slug,
                'image' => $result->image ? $result->image : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'shortDetails' => $result->short_details ? $result->short_details : null,
                'details' => $result->details ? $result->details : null,
                'userId' => [
                    'id' => $result->user_id,
                    'name' => $result->user_id && $result->admin->f_name ? $result->admin->AdminName() : null,
                    'status' => $result->user_id && $result->admin->role->status ? $result->admin->role->status : null
                ],
                'status' => $result->status
            ];
        }
        return $results;
    }
    public function resultBlogDetail($data)
    {
        foreach ($data as $result) {
            return [
                'id'   => $result->id,
                'categoryBlog' => [
                    'id' => $result->blog_category_id,
                    'name' => $result->blog_category_id && $result->blog_category->name ? $result->blog_category->name : null,
                    'slug' => $result->blog_category_id && $result->blog_category->slug ? $result->blog_category->slug : null,
                ],
                'title' => $result->title,
                'slug' => $result->slug,
                'image' => $result->image ? $result->image : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'shortDetails' => $result->short_details ? $result->short_details : null,
                'details' => $result->details ? $result->details : null,
                'userId' => [
                    'id' => $result->user_id,
                    'name' => $result->user_id && $result->admin->f_name ? $result->admin->AdminName() : null,
                    'status' => $result->user_id && $result->admin->role->status ? $result->admin->role->status : null
                ],
                'status' => $result->status
            ];
        }
    }

    public function queryBlogList($data)
    {
        $request_q = $data['request_q']; // title blog
        $category  = $data['category']; // slug category-blog
        $sort      = $data['sort'];
        $perPage   = $data['perPage'];

        if ($request_q && $category) {
            return BlogModel::whereHas('blog_category', function ($q) use ($category) {
                return $q->where('slug', '=', $category);
            })->where([['title', '=', $request_q], ['status', '=', 1]])->orderBy('id', $sort)->paginate($perPage);
        } elseif ($request_q) {
            return BlogModel::where([['title', '=', $request_q], ['status', '=', 1]])->orderBy('id', $sort)->paginate($perPage);
        } elseif ($category) {
            return BlogModel::whereHas('blog_category', function ($q) use ($category) {
                return $q->where('slug', '=', $category);
            })->where('status', '=', 1)->orderBy('id', $sort)->paginate($perPage);
        } else {
            return BlogModel::where('status', '=', 1)->orderBy('id', $sort)->paginate($perPage);
        }
    }
}
