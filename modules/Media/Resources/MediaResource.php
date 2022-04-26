<?php


namespace Modules\Media\Resources;


use App\Resources\BaseJsonResource;

class MediaResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'thumb_size'=>$this->viewUrl('thumb'),
            'full_size'=>$this->viewUrl('full'),
            'medium_size'=>$this->viewUrl('medium'),
            'file_path'=>$this->file_path,
            'file_name'=>$this->file_name,
            'file_type'=>$this->file_type,
        ];
    }
}
