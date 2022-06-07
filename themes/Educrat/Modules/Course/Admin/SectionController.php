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

    public function index(Request $request, $course_id)
    {
        $this->checkPermission('product_manage_others');

        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }

        $listSection = $this->sectionsClass::where("course_id", $course_id);
        if (!empty($search = $request->query('s'))) {
            $listSection->where('name', 'LIKE', '%' . $search . '%');
        }
        $listSection->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listSection->get(),
            'row'         => new $this->sectionsClass(),
            'course'       => $this->currentCourse,
            'translation'    => new SectionTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Course'),
                    'url'  => route('product.admin.index')
                ],
                [
                    'name' => __('Course: :name',['name'=>$this->currentCourse->title]),
                    'url'  => route('product.admin.edit',['id' => $this->currentCourse->id])
                ],
                [
                    'name'  => __('Sections'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Course::admin.section.index', $data);
    }

    public function edit(Request $request, $course_id, $id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }

        $row = $this->sectionsClass::find($id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Sections not found!'));
        }
        $translation = $row->translate($request->query('lang'));
        $this->checkPermission('product_manage_others');
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'rows'        => $this->sectionsClass::where("service", 'course')->get(),
            'row'         => $row,
            'course'       => $this->currentCourse,
            'breadcrumbs' => [
                [
                    'name' => __('Course'),
                    'url'  => route('product.admin.index')
                ],
                [
                    'name' => __('Course: :name',['name'=>$this->currentCourse->title]),
                    'url'  => route('product.admin.edit',['id' => $this->currentCourse->id])
                ],
                [
                    'name' => __('Sections'),
                    'url'  => route('course.admin.section.index',['course_id' => $this->currentCourse->id])
                ],
                [
                    'name'  => __('Section: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Course::admin.section.detail', $data);
    }

    public function store(Request $request, $course_id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }

        $this->checkPermission('product_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        $id = $request->input('id');
        if ($id) {
            $row = $this->sectionsClass::find($id);
            if (empty($row)) {
                return redirect()->back()->with('error', __('Sections not found!'));
            }
        } else {
            $row = new $this->sectionsClass($request->input());
            $row->service = 'course';
        }
        $input = $request->input();
        $input['course_id'] = $course_id;
        $row->fill($input);
        $res = $row->saveOriginOrTranslation($request->input('lang'));
        if ($res) {
            return redirect()->back()->with('success', __('Section saved'));
        }
    }

    public function store_ajax($id = ''){
        $row = $this->hasCoursePermission($id);

        if(empty($row)){
            return $this->sendError(__("Course not found"));
        }
        $rules = [
            'name'=>'required',
        ];

        request()->validate($rules);

        if($section_id = request()->input('id')){
            $section = Section::find($section_id);
            if(empty($section)){
                return $this->sendError(__("Section not found"));
            }
        }else{
            $section = new Section();
            $section->course_id = $id;
        }

        $section->fillByAttr([
            'name',
            'active',
            'display_order'
        ],request()->input());

        $section->save();

        if($section_id){
            return $this->sendSuccess(__("Section updated"));
        }else{
            return $this->sendSuccess(['section'=>$section],__("Section created"));
        }
    }


    public function editSectionBulk(Request $request, $course_id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }

        $this->checkPermission('product_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->sectionsClass::where("id", $id);
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }

    public function lessons(Request $request, $course_id, $section_id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }
        $this->checkPermission('product_manage_others');
        $row = $this->sectionsClass::find($section_id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Lesson not found'));
        }
        $listLessons = $this->lessonsClass::where("section_id", $section_id);
        if (!empty($search = $request->query('s'))) {
            $listLessons->where('name', 'LIKE', '%' . $search . '%');
        }
        $listLessons->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listLessons->paginate(20),
            'section'        => $row,
            "row"         => new $this->lessonsClass(),
            'course'       => $this->currentCourse,
            'translation'    => new LessonTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Course'),
                    'url'  => route('product.admin.index')
                ],
                [
                    'name' => __('Course: :name',['name'=>$this->currentCourse->title]),
                    'url'  => route('product.admin.edit',['id' => $this->currentCourse->id])
                ],
                [
                    'name' => __('Sections'),
                    'url'  => route('course.admin.section.index',['course_id' => $this->currentCourse->id])
                ],
                [
                    'name'  => __('Section: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Course::admin.lessons.index', $data);
    }

    public function lesson_edit(Request $request, $course_id, $id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }
        $this->checkPermission('product_manage_others');
        $row = $this->lessonsClass::find($id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Lesson not found'));
        }
        $translation = $row->translate($request->query('lang'));
        $section = $this->sectionsClass::find($row->section_id);
        $data = [
            'row'         => $row,
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'course'       => $this->currentCourse,
            'breadcrumbs' => [
                [
                    'name' => __('Course'),
                    'url'  => 'admin/module/course'
                ],
                [
                    'name' => __('Course: :name',['name'=>$this->currentCourse->title]),
                    'url'  => route('product.admin.edit',['id' => $this->currentCourse->id])
                ],
                [
                    'name' => __('Sections'),
                    'url'  => route('course.admin.section.index',['course_id' => $this->currentCourse->id])
                ],
                [
                    'name' => $section->name,
                    'url'  => route('course.admin.section.lesson.index',['course_id' => $this->currentCourse->id, 'id' => $row->section_id])
                ],
                [
                    'name'  => __('Lesson: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Course::admin.lessons.detail', $data);
    }

    public function lesson_store(Request $request, $course_id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }
        $this->checkPermission('product_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        $id = $request->input('id');
        if ($id) {
            $row = $this->lessonsClass::find($id);
            if (empty($row)) {
                return redirect()->back()->with('error', __('Lesson not found'));
            }
        } else {
            $row = new $this->lessonsClass($request->input());
            $row->section_id = $request->input('section_id');
        }
        $input = $request->input();
        $input['course_id'] = $course_id;
        $row->fill($input);
        $row->image_id = $request->input('image_id');
        $row->icon = $request->input('icon');
        $res = $row->saveOriginOrTranslation($request->input('lang'));
        if ($res) {
            return redirect()->back()->with('success', __('Lesson saved'));
        }
    }

    public function editLessonBulk(Request $request, $course_id)
    {
        if(!$this->hasCoursePermission($course_id))
        {
            abort(403);
        }
        $this->checkPermission('product_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->lessonsClass::where("id", $id);
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
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
}
