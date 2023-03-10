<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\User\Helpers\PermissionHelper;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \Modules\User\Models\Role::firstOrCreate([
            'code'=>'admin',
            'name'=>'Admin',
            'commission'=>100,
            'commission_type'=>'percent'
        ]);
        $admin->givePermission(PermissionHelper::all());

        $customer = \Modules\User\Models\Role::firstOrCreate([
            'code'=>'customer',
            'name'=>'Customer'
        ]);

        $vendor = \Modules\User\Models\Role::firstOrCreate([
            'code'=>'vendor',
            'name'=>'Vendor'
        ]);
        $vendor->givePermission([
            'product_view',
            'product_create',
            'product_update',
            'product_delete',
            'pos_access',
            'vendor_access'
        ]);

        setting_update_item('vendor_role',$vendor->id);
    }

}
