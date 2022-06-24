<?php


namespace Modules\Review\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Resources\UserResource;

class ReviewResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'author'=>new UserResource($this->author),
            'created_at'=>$this->created_at,
            'rate_number'=>$this->rate_number
        ];
    }
}
