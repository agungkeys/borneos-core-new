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
            $query = ModelsFAQ::select('category_faq_id')->where([['status','=',1]])->groupBy('category_faq_id')->orderBy('category_faq_id',$sort)->paginate($perPage);
            foreach($query as $result){
                $results[] = [
                    'id' => $result->category_faq_id ? $result->category_faq_id : null,
                    'faqCategoryId' => $result->category_faq_id ? $result->category_faq_id : null,
                    'faqCategoryName' => $result->category_faq_id && $result->category ? $result->category->title : null,
                    'faqs' => $this->resultListFAQ($result->category_faq_id ? $result->category_faq_id : null)
                ];
            }
            return $results;
        }else{
            $query = ModelsFAQ::select('category_faq_id')->where([['type','=',$type],['status','=',1]])->groupBy('category_faq_id')->orderBy('category_faq_id',$sort)->paginate($perPage);
            foreach($query as $result){
                $results[] = [
                    'id' => $result->category_faq_id ? $result->category_faq_id : null,
                    'faqCategoryId' => $result->category_faq_id ? $result->category_faq_id : null,
                    'faqCategoryName' => $result->category_faq_id && $result->category ? $result->category->title : null,
                    'faqs' => $this->resultListFaqByType(['category_faq_id'=>$result->category_faq_id ?? null,'type'=>$type,'sort'=>$sort,'perPage'=>$perPage])
                ];
            }
            return $results;
        }
    }
    public function resultListFAQ($data)
    {
        if($data == null){
            return null;
        }else{
            $query = ModelsFAQ::where([['category_faq_id','=',$data],['status','=',1]])->get();
            foreach($query as $result){
                $results[] = [
                    'id' => $result->id,
                    'categoryFaqId' => $result->category_faq_id ? $result->category_faq_id : null,
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
    public function resultListFaqByType($data)
    {
        if($data['category_faq_id'] == null){
            return null;
        }else{
            $query = ModelsFAQ::where([['category_faq_id','=',$data['category_faq_id']],['type','=',$data['type']],['status','=',1]])->orderBy('id',$data['sort'])->paginate($data['perPage']);
            foreach($query as $result){
                $results[] = [
                    'id' => $result->id,
                    'categoryFaqId' => $result->category_faq_id ? $result->category_faq_id : null,
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
}