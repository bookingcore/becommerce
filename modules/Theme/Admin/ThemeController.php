<?php

namespace Modules\Theme\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\AdminController;
use Modules\Theme\ThemeManager;

class ThemeController extends AdminController
{
    /**
     * @var ThemeManager
     */
    protected $theme_manager;
    public function __construct(ThemeManager $theme_manager)
    {
        parent::__construct();
        $this->setActiveMenu(route('theme.admin.index'));
        $this->theme_manager = $theme_manager;
    }

    public function index(Request $request){
        $this->checkPermission("theme_manage");

        $data = [
            "rows"=>ThemeManager::all(),
            "page_title"=>__("Theme management")
        ];

        return view('Theme::admin.index',$data);
    }

    public function upload(Request $request){
        $this->checkPermission("theme_manage");

        $data = [
            "page_title"=>__("Theme Upload")
        ];

        return view('Theme::admin.upload',$data);
    }

    public function upload_post(Request $request){
        if(is_demo_mode()){
            return back()->with('danger',__("DEMO MODE: You are not allowed to do that"));
        }
        $this->checkPermission("theme_manage");

        $request->validate([
            'file'=>[
                'required',
                'mimes:zip',
                'mimetypes:application/zip'
            ]
        ]);
        $file = $request->file('file');
        if(!$file){
            return redirect()->back()->with('danger',__("Please select file"));
        }

        $zipArchive = new \ZipArchive();
        if ($zipArchive->open($file->getRealPath())) {
            // Extracts to current directory
            $zipArchive->extractTo(base_path('/'));
        } else {
            return redirect()->back()->with('danger',__("Can not open zip file"));
        }

        return redirect(route('theme.admin.index'))->with('success','Theme uploaded');
    }

    public function activate(Request $request,$theme){
        if(is_demo_mode()){
            return back()->with('danger',__("DEMO MODE: You are not allowed to do that"));
        }
        $this->checkPermission("theme_manage");

        $request->merge(['theme' => $theme]);

        $request->validate([
            'theme'=>'required|regex:/^[A-Za-z0-9_]+$/'
        ]);


        $theme = strip_tags(trim($theme));

        if(!ThemeManager::validateTheme($theme)){
            return back()->with('danger',__("Selected theme is not available"));
        }

        try{
            if(!ThemeManager::saveConfigFile(["BC_ACTIVE_THEME"=>trim($theme)])){
                return back()->with('danger',__("Can not write file config at").' '.storage_path('bc.php'));
            }
        }catch (\Throwable $throwable)
        {
            return back()->with('danger',$throwable->getMessage());
        }

        return back()->with('success',__("Theme activated"));
    }


    public function seeding($theme){
        if(is_demo_mode()){
            return back()->with('danger',__("DEMO MODE: You are not allowed to do that"));
        }

        $this->checkPermission("theme_manage");

        $provider = $this->theme_manager::theme($theme);

        if(class_exists($provider))
        {
            $seeder = $provider::$seeder;
            if(!class_exists($seeder)) return back()->with('error',__("This theme does not have seeder class"));

            $provider::runSeeder();

            return back()->with('success',__("Demo data has been imported"));

        }

        return back()->with('error',__("Can not run data import"));
    }
}
