<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new \App\User([
            'first_name' => 'System',
            'last_name' => 'Admin',
            'email' => 'admin@becommerce.test',
            'password' => bcrypt('admin123'),
            'phone'   => '112 666 888',
            'status'   => 'publish',
            'created_at' =>  date("Y-m-d H:i:s"),
            'bio'=> 'We\'re designers who have fallen in love with creating spaces for others to reflect, reset, and create. We split our time between two deserts (the Mojave, and the Sonoran). We love the way the heat sinks into our bones, the vibrant sunsets, and the wildlife we get to call our neighbors.',
        ]);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->need_update_pw = 1;
        $user->save();
        $user->assignRole('admin');

        $user = new \App\User([
            'first_name' => 'Customer',
            'email' => 'customer@becommerce.test',
            'password' => bcrypt('admin123'),
            'phone'   => '112 666 888',
            'status'   => 'publish',
            'created_at' =>  date("Y-m-d H:i:s"),
        ]);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->need_update_pw = 1;
        $user->save();
        $user->assignRole('customer');

    }
}
