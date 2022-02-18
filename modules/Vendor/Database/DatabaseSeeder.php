<?php


namespace Modules\Vendor\Database;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(){
        setting_update_item('vendor_payout_methods',[
            ['id'=>'bank_transfer','name'=>'Bank Transfer']
        ]);
    }
}
