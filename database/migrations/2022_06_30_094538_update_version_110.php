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

        Schema::table('products',function (Blueprint $table){
            if(!Schema::hasColumn('products','downloadable')){
                $table->tinyInteger('downloadable')->nullable()->default(0);
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
        Schema::table('products', function (Blueprint $table) {
            if(Schema::hasColumn('products','downloadable')){
                $table->dropColumn('downloadable');
            }
        });
    }
};
