<?php
namespace Themes\Educrat\Modules\Course\Models;

use App\BaseModel;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Lesson extends BaseModel
{
    use SoftDeletes;

    protected $table = 'course_lessons';

    public $table_translation = 'course_section_translations';

    protected $translation_class = SectionTranslation::class;

    protected $fillable = [
        'name',
        'content',
        'duration',
        'image_id',
        'course_id',
        'active',
        'url',
        'type',
        'preview_url'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';


    /**
     * @param $lesson_IDs array or number
     * @return mixed
     */
    static public function getLessonsById($lesson_IDs){
        $listLessons = [];
        if(empty($lesson_IDs)) return $listLessons;
        $lessons = parent::query()->with(['translation','section'])->find($lesson_IDs);
        if(!empty($lessons)){
            foreach ($lessons as $lesson){
                if(!empty($attr = $lesson->section)){
                    if(empty($listLessons[$lesson->attr_id]['child'])) $listLessons[$lesson->attr_id]['parent'] = $attr;
                    if(empty($listLessons[$lesson->attr_id]['child'])) $listLessons[$lesson->attr_id]['child'] = [];
                    $listLessons[$lesson->attr_id]['child'][] = $lesson;
                }
            }
        }
        return $listLessons;
    }

    public function section()
    {
        return $this->hasOne("Modules\Course\Models\Sections", "id" , "section_id");
    }

    public function course()
    {
        return $this->hasOne("Modules\Course\Models\Course", "id" , "course_id");
    }


    public static function getForSelect2Query($service,$q=false)
    {
        $query =  static::query()->select('course_lessons.id', DB::raw('CONCAT(at.name,": ",course_lessons.name) as text'))
        ->join('course_section as bcs','bcs.id','=','course_lessons.attr_id')
        ->where("bcs.service",$service)
        ->whereRaw("bcs.deleted_at is null");

        if ($query) {
            $query->where('course_lessons.name', 'like', '%' . $q . '%');
        }
        return $query;
    }

    public function getDurationHtmlAttribute(){
        return $this->duration_html = $this->duration ? convertToHoursMinutes($this->duration) : '';
    }

    public function getStudyUrlAttribute(){
        $url = $this->file_id ? get_file_url($this->file_id) : $this->url;
        switch ($this->type){
            case "presentation":
                if($this->file_id) {
                    if (strpos($url, '.ppt')) {
                        $url = asset('libs/ViewerJS/#' . ($url));
                    } else {
                        $url = asset('libs/pdfjs/web/viewer.html?file=' . urlencode($url));
                    }
                }
                break;
            case "scorm":
                if($this->file_id){
                    $url = route('course.scorm_player',['id'=>$this->file_id]);
                }
                break;
        }
        if(!$this->file_id){
            $url = getYoutubeEmbedUrl($url);
        }
        return $url;
    }

}
