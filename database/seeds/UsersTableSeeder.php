<?php

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

        DB::table('users')->insert([
            'first_name' => 'System',
            'last_name' => 'Admin',
            'email' => 'admin@dev.com',
            'password' => bcrypt('admin123'),
            'phone'   => '112 666 888',
            'status'   => 'publish',
            'created_at' =>  date("Y-m-d H:i:s"),
            'bio'=> 'We\'re designers who have fallen in love with creating spaces for others to reflect, reset, and create. We split our time between two deserts (the Mojave, and the Sonoran). We love the way the heat sinks into our bones, the vibrant sunsets, and the wildlife we get to call our neighbors.'
        ]);
        $user = \App\User::where('email','admin@dev.com')->first();
        $user->assignRole('administrator');

    }
}
