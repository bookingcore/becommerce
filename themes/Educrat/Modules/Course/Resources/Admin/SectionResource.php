<?php


namespace Themes\Educrat\Modules\Course\Resources\Admin;


use App\Resources\BaseJsonResource;

class SectionResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'lessons'=>$this->whenNeed('lessons',function(){
                return LessonResource::collection($this->lessons);
            })
        ];
    }
}
