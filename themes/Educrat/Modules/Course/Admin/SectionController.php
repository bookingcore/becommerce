<?php
namespace Themes\Educrat\Modules\Course\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Themes\Educrat\Modules\Course\Models\Section;
use Themes\Educrat\Modules\Course\Models\SectionTranslation;
use Themes\Educrat\Modules\Course\Models\Lesson;
use Themes\Educrat\Modules\Course\Models\LessonTranslation;
use Themes\Educrat\Modules\Course\Models\Course;

class SectionController extends AdminController
{
    protected $courseClass;
    protected $sectionsClass;
    protected $lessonsClass;
    protected $currentCourse;

    public function __construct()
    {
        $this->setActiveMenu('product');
        parent::__construct();
        $this->courseClass = Course::class;
        $this->sectionsClass = Section::class;
        $this->lessonsClass = Lesson::class;
    }


    protected function hasCoursePermission($course_id = false){
        if(empty($course_id)) return false;

        $course = $this->courseClass::find($course_id);
        if(empty($course)) return false;

        if(!$this->hasPermission('product_manage_others') and $course->create_user != Auth::id()){
            return false;
        }

        $this->currentCourse = $course;
        return true;
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            if(is_array($selected))
            {
                $query = $this->lessonsClass::getForSelect2Query('course');
                $items = $query->whereIn('course_lessons.id',$selected)->take(50)->get();
                return response()->json([
                    'items'=>$items
                ]);
            }

            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->lessonsClass::getForSelect2Query('course',$q);
        $res = $query->orderBy('course_lessons.id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function getSectionForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = $this->sectionsClass::selectRaw("id,name as text")->where('service','course');
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }



    public function delete(Request $request,$id){
        $row = $this->hasCoursePermission($id);

        if(empty($row)){
            return $this->sendError(__("Course not found"));
        }

        $request->validate([
            'section_id'=>'required'
        ]);

        $section = Section::query()->where('id',$request->input('section_id'))->where('course_id',$id)->first();

        if(!$section){
            return $this->sendError(__("Section not found"));
        }

        $section->lessons()->delete();
        $section->delete();

        return $this->sendSuccess(__("Section deleted"));
    }
}
