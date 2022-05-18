<?php


namespace Modules\User\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends BaseModel
{

    use SoftDeletes;

    protected $table = 'core_plans';
    public $type = 'plan';

    public function durationText(): Attribute
    {
        return Attribute::make(
            get:function($value){
                $html = '';
                switch ($this->duration_type){
                    case "day":
                        if($this->duration <= 1)
                            $html = __(":duration day",['duration'=>$this->duration]);
                        else
                            $html = __(":duration days",['duration'=>$this->duration]);
                    break;
                    case "week":
                        if($this->duration <= 1)
                            $html = __(":duration week",['duration'=>$this->duration]);
                        else
                            $html = __(":duration weeks",['duration'=>$this->duration]);
                    break;
                    case "month":
                        if($this->duration <= 1)
                            $html = __(":duration month",['duration'=>$this->duration]);
                        else
                            $html = __(":duration months",['duration'=>$this->duration]);
                    break;
                    case "year":
                        if($this->duration <= 1)
                            $html = __(":duration year",['duration'=>$this->duration]);
                        else
                            $html = __(":duration years",['duration'=>$this->duration]);
                    break;
                }
                return $html;
            }
        );

    }
    public function durationTypeText(): Attribute
    {
        return Attribute::make(
            get:function($value){
                switch ($this->duration_type){
                    case "day":
                        return __("daily");
                    break;
                    case "week":
                        return __("weekly");
                    break;
                    case "month":
                        return __("monthly");
                    break;
                    case "year":
                        return __("yearly");
                    break;
                }
            }
        );
    }

    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }
}
