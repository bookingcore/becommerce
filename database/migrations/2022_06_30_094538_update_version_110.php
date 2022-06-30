<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_orders',function (Blueprint $table){
            if(!Schema::hasColumn('core_orders','channel')){
                $table->string('channel',30)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_orders', function (Blueprint $table) {
            if(Schema::hasColumn('core_orders','channel')){
                $table->dropColumn('channel');
            }
        });
    }
};
