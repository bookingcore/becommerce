<?php

namespace Themes\Educrat\Modules\Course\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Themes\Educrat\Modules\Course\Models\Course;
use Themes\Educrat\Modules\Course\Models\Lesson;
use Themes\Educrat\Modules\Course\Resources\Admin\LessonResource;

class LessonController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('product.admin.index'));
    }

    public function index($id = ''){
        $row = $this->checkItemPermission($id);

        if(empty($row)){
            abort(403);
        }

        $data = [
            'rows'=>$row->sections,
            'row'=>$row,
            'page_title'=>__("Lessons Management"),
            'breadcrumbs'        => [
                [
                    'name' => __('Courses'),
                    'url'  => route('product.admin.index')
                ],
                [
                    'name'  => $row->title,
                    'url'  => route('product.admin.edit',['id'=>$row->id]),
                ],
                [
                    'name'  => __("Lessons Management"),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Course::admin.lesson.index',$data);
    }

    public function store($id = ''){
        $row = $this->checkItemPermission($id);

        if(empty($row)){
            return $this->sendError(__("Course not found"));
        }
        $type = request()->input('type');
        $section_id = request()->input('section_id');

        $rules = [
            'name'=>'required',
            'duration'=>'required',
            'type'=>'required',
            'section_id'=>'required'
        ];


        request()->validate($rules);

        if($module_id = request()->input('id')){
            $module = Lesson::find($module_id);
            if(empty($module)){
                return $this->sendError(__("Lesson not found"));
            }
        }else{
            $module = new Lesson();
            $module->course_id = $id;
            $module->section_id = $section_id;
        }

        $module->fillByAttr([
            'name',
            'file_id',
            'active',
            'preview_url',
            'url',
            'duration',
            'type',
            'display_order'
        ],request()->input());

        $module->save();

        if($module_id){
            return $this->sendSuccess(['lecture'=>new LessonResource($module)],__("Lesson updated"));
        }else{
            return $this->sendSuccess(['lecture'=>new LessonResource($module)],__("Lesson created"));
        }
    }

    protected function checkItemPermission($id){

        if(empty($id)) return false;
        $row = Course::find($id);

        if(empty($row)) return false;

        if(!$this->hasPermission('product_manage_others'))
        {
            if($row->create_user != Auth::id()){
                return false;
            }
        }
        return $row;
    }

    public function delete(Request $request,$id){
        $row = $this->checkItemPermission($id);

        if(empty($row)){
            return $this->sendError(__("Course not found"));
        }

        $request->validate([
            'lesson_id'=>'required'
        ]);

        $lesson = Lesson::query()->where('id',$request->input('lesson_id'))->where('course_id',$id)->first();

        if(!$lesson){
            return $this->sendError(__("Lesson not found"));
        }

        $lesson->delete();

        return $this->sendSuccess(__("Lesson deleted"));
    }
}
