<?php
namespace Themes\Educrat\Modules\Course\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends BaseModel
{
    use SoftDeletes;
    protected $table = 'course_section';
    protected $fillable = ['name', 'display_type', 'hide_in_single', 'course_id','active'];
    protected $slugField = 'slug';
    protected $slugFromField = 'name';

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'section_id', 'id')->orderBy("display_order", "asc")->with(['translation']);
    }
    public function frontendLessons(){
        return $this->hasMany(Lesson::class,'section_id','id')->where('active',1)->orderBy('display_order','ASC');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, "course_id");
    }

    public function getLessonsStudyJsDataAttribute(){
        $res = [];
        foreach($this->frontendLessons as $module){

            $res[] = [
                'id'=>$module->id,
                'title'=>$module->name,
                'study_url'=>$module->study_url,
                'duration_html'=>$module->duration_html
            ];
        }
        return $res;
    }
}
