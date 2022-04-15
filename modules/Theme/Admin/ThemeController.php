<?php

namespace Modules\Theme\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Modules\AdminController;
use Modules\Core\JsonConfigManager;
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

    public function activate($theme){
        $this->checkPermission("theme_manage");

        try{
            JsonConfigManager::set("active_theme",trim($theme));
        }catch (\Throwable $throwable)
        {
            back()->with('danger',$throwable->getMessage());
        }

        return back()->with('success',__("Theme activated"));
    }

    public function seeding($theme){
        $this->checkPermission("theme_manage");

        $provider = $this->theme_manager::getProviderClass($theme);

        if(class_exists($provider))
        {
            $seeder = $provider::$seeder;
            if(!class_exists($seeder)) return back()->with('error',__("This theme does not have seeder class"));

            Artisan::call('db:seed', ['--class' => $seeder,'--force'=>true]);

            return back()->with('success',__("Demo data has been imported"));

        }

        return back()->with('error',__("Can not run data import"));
    }
}
