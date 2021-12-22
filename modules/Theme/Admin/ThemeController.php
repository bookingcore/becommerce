<?php

namespace Modules\Theme\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
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
}
