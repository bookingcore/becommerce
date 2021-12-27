<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\AdminController;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsController extends AdminController
{
    protected $groups = [];

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/core/settings/index/general');
    }

    public function index($group)
    {

        if(empty($this->groups)){
            $this->setGroups();
        }

        $this->checkPermission('setting_manage');
        $settingsGroupKeys = array_keys($this->groups);
        if (empty($group) or !in_array($group, $settingsGroupKeys)) {
            $group = $settingsGroupKeys[0];
        }
        $group_options = $this->groups[$group];
        $data = [
            'current_group' => $group,
            'groups'        => $this->groups,
            'settings'      => Settings::getSettings($group_options['keys']),
            'breadcrumbs'   => [
                ['name' => $this->groups[$group]['name'] ?? $this->groups[$group]['title'] ?? ''],
            ],
            'page_title'    => $this->groups[$group]['name'] ?? $this->groups[$group]['title'] ?? $group,
            'group'         => $this->groups[$group],
            'enable_multi_lang'=>true
        ];
        return view('Core::admin.settings.index', $data);
    }

    public function store(Request $request, $group)
    {

        $this->checkPermission('setting_manage');
        $group_data = SettingManager::page($group);
        dd($group_data);

        $keys = [];
        $htmlKeys = [];
        $filter_demo_mode = [];

        if(!empty($group_data['keys'])) $keys = $group_data['keys'];
        if(!empty($group_data['html_keys'])) $htmlKeys = $group_data['html_keys'];

        $filter_demo_mode = $group_data['filter_demo_mode'] ?? $filter_demo_mode;
        if(!is_demo_mode()){
            $filter_demo_mode = [];
        }

        $lang = $request->input('lang');
        if(is_default_lang($lang)) $lang = false;

        if (!empty($request->input())) {
            if (!empty($keys)) {
                $all_values = $request->input();
                //If we found callback validate data before save
                if(!empty($group_data['filter_values_callback']) and is_callable($group_data['filter_values_callback']))
                {
                    $all_values = call_user_func($group_data['filter_values_callback'],$all_values,$request);
                }

                foreach ($keys as $key) {
                    if(in_array($key,$filter_demo_mode)){
                        continue;
                    }
                    $setting_key = $key.($lang ? '_'.$lang : '');

                    if (in_array($key, $htmlKeys)) {
                        $all_values[$key] = clean($all_values[$key] ?? '');
                    }
                    setting_update_item($setting_key,$all_values[$key] ?? null);
                }
            }
            //Clear Cache for currency
            Session::put('bc_current_currency',"");

            return redirect()->back()->with('success', __('Settings Saved'));
        }
    }


    protected function setGroups(){
        $this->groups = SettingManager::all();
    }
}
