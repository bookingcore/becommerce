<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Models\Settings;
use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;
use Modules\Review\Models\Review;
use Modules\Space\Models\Space;
use Modules\Tour\Models\Tour;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_page_id = setting_item('home_page_id');
        if($home_page_id && $page = Page::where("id",$home_page_id)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $seo_meta = $page->getSeoMeta();
            $seo_meta['full_url'] = url("/");
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'is_homepage'  => true,
                'page_style' => $page->page_style,
                'compare'      => (session('compare')) ? session('compare') : '',
                'breadcrumbs' => [
                    ['name' => $page->title,'class' => 'active'],
                ],
            ];
            return view('Page::frontend.detail',$data);
        }
        $model_News = News::where("status", "publish");
        $data = [
            'rows'=>$model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index',$data);
    }

    public function test()
    {
        Artisan::call('cache:clear');
    }

    public function updateMigrate(){
        Artisan::call('cache:clear');
        Artisan::call('migrate', [
            '--force' => true,
        ]);
        echo $this->updateTo110();
        echo "<br>";
        echo $this->updateTo120();
        echo "<br>";
        echo $this->updateTo130();
        Artisan::call('cache:clear');
        die();
    }

    /**
     * @todo Update From 1.0 to 1.1
     */
    public function updateTo110(){
        if(setting_item('update_to_110')){
            return "Updated Up 1.10";
        }
        Permission::findOrCreate('dashboard_vendor_access');
        $vendor = Role::findOrCreate('vendor');
        $vendor->givePermissionTo('media_upload');
        $vendor->givePermissionTo('tour_view');
        $vendor->givePermissionTo('tour_create');
        $vendor->givePermissionTo('tour_update');
        $vendor->givePermissionTo('tour_delete');
        $vendor->givePermissionTo('dashboard_vendor_access');
        $role = Role::findOrCreate('administrator');
        $role->givePermissionTo('dashboard_vendor_access');
        Settings::store('update_to_110',true);
        return "Migrate Up 1.10";
    }

    /**
     * @todo Update From 1.1.0 to 1.2.0
     */
    public function updateTo120(){

        if(setting_item('update_to_120')){
            return "Updated Up 1.20";
        }
        Permission::findOrCreate('space_view');
        Permission::findOrCreate('space_create');
        Permission::findOrCreate('space_update');
        Permission::findOrCreate('space_delete');
        Permission::findOrCreate('space_manage_others');
        Permission::findOrCreate('space_manage_attributes');
        // Vendor
        $vendor = Role::findOrCreate('vendor');
        $vendor->givePermissionTo('space_create');
        $vendor->givePermissionTo('space_view');
        $vendor->givePermissionTo('space_update');
        $vendor->givePermissionTo('space_delete');
        // Admin
        $role = Role::findOrCreate('administrator');
        $role->givePermissionTo('space_view');
        $role->givePermissionTo('space_create');
        $role->givePermissionTo('space_update');
        $role->givePermissionTo('space_delete');
        $role->givePermissionTo('space_manage_others');
        $role->givePermissionTo('space_manage_attributes');
        if(empty(setting_item('topbar_left_text'))){
            DB::table('core_settings')->insert(
                [
                    'name'  => 'topbar_left_text',
                    'val'   => '<div class="socials">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-google-plus"></i></a>
</div>
<span class="line"></span>
<a href="mailto:contact@bookingcore.org">contact@bookingcore.org</a>',
                    'group' => "general",
                ]
            );
        }
        Settings::store('update_to_120',true);
        return "Migrate Up 1.20";
    }

    public function updateTo130(){
//        if(setting_item('update_to_130')){
//            return "Updated Up 1.30";
//        }

        $this->__updateReviewVendorId();

        // Fix null status user
        User::query()->whereRaw('status is NULL')->update([
            'status'=>'publish'
        ]);

        Settings::store('update_to_130',true);
        return "Migrate Up 1.30";
    }

    protected function __updateReviewVendorId(){
        $all = Review::query()->whereNull('vendor_id')->get();
        if(!empty($all))
        {
            foreach ($all as $item){
                switch ($item->object_model)
                {
                    case "tour":
                        $tour = Tour::find($item->object_id);
                        if($tour){
                            $item->vendor_id = $tour->create_user;
                            $item->save();
                        }
                        break;
                    case "space":
                        $tour = Space::find($item->object_id);
                        if($tour){
                            $item->vendor_id = $tour->create_user;
                            $item->save();
                        }
                        break;
                }
            }
        }
    }

    public function checkConnectDatabase(Request $request){
        $connection = $request->input('database_connection');
        config([
            'database' => [
                'default' => $connection."_check",
                'connections' => [
                    $connection."_check" => [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ],
                ],
            ],
        ]);
        try {
            DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){
                return $this->sendSuccess(false , __("Yes! Successfully connected to the DB: ".DB::connection()->getDatabaseName()));
            }else{
                return $this->sendSuccess(false , __("Could not find the database. Please check your configuration."));
            }
        } catch (\Exception $e) {
            return $this->sendError( $e->getMessage() );
        }
    }
}
