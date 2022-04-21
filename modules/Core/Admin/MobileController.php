<?php


namespace Modules\Core\Admin;


use Modules\AdminController;
use Modules\Template\Models\Template;

class MobileController extends AdminController
{

    public function toBuilder(){
        $template_id = setting_item('api_app_layout');
        if(!$template_id or !$template = Template::find($template_id)){
            $template = new Template([
                'title'=>'Mobile Layout Builder'
            ]);
            $template->save();
        }

        return redirect(route('template.admin.edit',['id'=>$template->id]));
    }
}
