<?php

namespace Modules\Theme\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\JsonConfigManager;
use Modules\Theme\ThemeManager;

class ThemeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('theme.admin.index'));
    }

    public function index(Request $request){
        $this->checkPermission("theme_manage");

        $data = [
            "rows"=>ThemeManager::all(),
            "page_title"=>__("Theme management")
        ];

        return view('Theme::admin.index',$data);
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
}
