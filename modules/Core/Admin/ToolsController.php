<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;

class ToolsController extends AdminController
{
    public function index()
    {
        $this->setActiveMenu('admin/module/core/tools');
        return view('Core::admin.tools.index');
    }
    public function schedule(Request  $request)
    {
        if($request->isMethod('post')){
            \Cache::forget('last_schedule_check');
            $seconds = strtotime(date('H:i:00',strtotime('+1 minute'))) - time();
            sleep($seconds+5);
        }
        return view('Core::admin.tools.schedule');
    }
}
