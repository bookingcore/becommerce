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
            'name'=>'Admin'
        ]);

        $admin->givePermission(PermissionHelper::all());


    }

}
