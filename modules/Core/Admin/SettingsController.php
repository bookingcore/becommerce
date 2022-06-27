<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsController extends AdminController
{
    protected $groups = [];

    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('setting');
    }

    public function index()
    {
        $data = [
            'settings'=>SettingManager::all(),
            'page_title'    =>__("Settings"),
        ];
        return view('Core::admin.settings.index', $data);
    }
    public function group($group)
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
        return view('Core::admin.settings.group', $data);
    }

    public function zone($zone_id){
        $group_id = \request('group');
        $zone = SettingManager::zone($zone_id);
        if(!$zone){
            abort(404);
        }

        $this->checkPermission('setting_manage');
        $groups = SettingManager::all($zone_id);

        $settingsGroupKeys = array_keys($groups);
        if (empty($group_id)) {
            $group_id = $settingsGroupKeys[0];
        }elseif(!in_array($group_id, $settingsGroupKeys)){
            abort(404);
        }

        $group = $groups[$group_id];
        AdminMenuManager::setActive('setting_'.$zone_id);
        $data = [
            'group' =>$group,
            'groups'        => $groups,
            'breadcrumbs'   => [
                ['name' => $group['name'] ?? $group['title'] ?? ''],
            ],
            'page_title'    => $group['name'] ?? $group['title'] ?? '',
            'enable_multi_lang'=>true,
            'zone'=>$zone,
            'current_group'=>$group_id,
            'zone_id'=>$zone_id
        ];
        return view('Core::admin.settings.group', $data);
    }

    public function store(Request $request, $group)
    {
        if(is_demo_mode()){
            return back()->with('error',__('DEMO Mode: You are not allowed to change'));
        }

        $this->checkPermission('setting_manage');
        $zone_id = $request->input('zone_id');
        if($zone_id){
            $zone = SettingManager::zone($zone_id);
            if(!$zone){
                return back()->with('error',__("Zone not found"));
            }
            $groups = SettingManager::all($zone_id);
            if(!array_key_exists($group,$groups)){
                return back()->with('error',__("Setting page not found"));
            }

            $group_data = $groups[$group];
        }else{
            $group_data = SettingManager::page($group);
        }

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
        else{
            if(!empty($group_data['translation_keys'])) $keys = $group_data['translation_keys'];
        }

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
            if(in_array('core_current_currency',$keys)){
                //Clear Cache for currency
                Session::put('core_current_currency',"");
            }
            if(in_array('style_custom_css',$keys)){
                //Clear Cache Custom Css
                Settings::clearCustomCssCache();
            }
            if(!empty($group_data['after_saving']) and is_callable($group_data['after_saving']))
            {
                call_user_func($group_data['after_saving']);
            }
            Artisan::call('queue:restart');

            return redirect()->back()->with('success', __('Settings Saved'));
        }
    }


    protected function setGroups(){
        $this->groups = SettingManager::all();
    }
}
