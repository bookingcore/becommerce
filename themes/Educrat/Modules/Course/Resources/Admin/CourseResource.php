<?php


namespace Themes\Educrat\Modules\Course\Resources\Admin;


use App\Resources\BaseJsonResource;

class CourseResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'sections'=>$this->whenNeed('sections',function (){
                $this->load('sections.lessons');
                return SectionResource::collection($this->sections,['lessons']);
            })
        ];
    }
}
