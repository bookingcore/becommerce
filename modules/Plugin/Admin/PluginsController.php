<?php
namespace Modules\Plugin\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Plugin\Facades\PluginManager;

class PluginsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('plugin');
    }

    public function index(Request $request)
    {
        $this->checkPermission('plugin_manage');
        $plugins = PluginManager::all();
        $data = [
            'rows'               => $plugins,
            'breadcrumbs'        => [
                [
                    'name' => __('Plugins'),
                    'url'  => route('plugin.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Plugin Management"),
            'active_plugins'=>PluginManager::activePlugins()
        ];
        return view('Plugin::admin.index', $data);
    }

    public function active(Request $request,$plugin){
        $active = $request->input('active');

        if($active){
            if(PluginManager::active($plugin)){
                return redirect()->back()->with('success', __('Plugin activated success!'));
            }

            return redirect()->back()->with('danger', __('Can not activate plugin!'));
        }else{

            if(PluginManager::deactive($plugin)){
                return redirect()->back()->with('success', __('Plugin deactivated success!'));
            }

            return redirect()->back()->with('danger', __('Can not deactivate plugin!'));
        }
    }
    public function bulkEdit(Request $request)
    {
        $this->checkPermission('plugin_manage');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action){
            case "active":
                foreach ($ids as $id){
                    PluginManager::active($id);
                }
                return redirect()->back()->with('success', __('Active success!'));
                break;
            case "deactivate":
                foreach ($ids as $id){
                    PluginManager::deactive($id);
                }
                return redirect()->back()->with('success', __('Deactivate success!'));
                break;
        }
    }
}
