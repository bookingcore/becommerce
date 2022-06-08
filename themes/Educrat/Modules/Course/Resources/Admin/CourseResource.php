<?php


namespace Themes\Educrat\Modules\Course\Resources\Admin;


use App\Resources\BaseJsonResource;
use Themes\Educrat\Modules\Course\Models\Section;

class CourseResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'sections'=>$this->whenNeed('sections',function (){
                $this->load('sections.lessons');
                $tmp = $this->sections;
                return SectionResource::collection($tmp,['lessons']);
            })
        ];
    }
}
