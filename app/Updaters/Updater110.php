<?php


namespace App\Updaters;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\Role;

class Updater110
{

    public static function run(){

        $check = '1.3';
        if(version_compare(setting_item('migration_110_schema'),$check,'>=')) return;

        Artisan::call('migrate --force');

        Schema::table('products',function (Blueprint $table){
            if(!Schema::hasColumn('products','is_virtual')){
                $table->tinyInteger('is_virtual')->nullable()->default(0);
            }
        });

        // POS Feature
        $cashier = \Modules\User\Models\Role::firstOrCreate([
            'code'=>'cashier',
            'name'=>'Cashier',
        ]);
        $cashier->givePermission([
            'product_view',
            'pos_access',
        ]);
        $vendor = Role::find('vendor');
        if($vendor){
            $vendor->givePermission([
                'pos_access',
            ]);
        }
        $admin = Role::find('admin');
        if($admin){
            $admin->givePermission([
                'pos_access',
            ]);
        }

        if(!setting_item('customer_role')){
            setting_update_item('customer_role',2);
        }

        setting_update_item('migration_110_schema',$check);
    }
}
