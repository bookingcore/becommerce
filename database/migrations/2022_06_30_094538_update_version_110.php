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
                $table->tinyInteger('download_expiry_days')->nullable()->default(0);
            }
            if(!Schema::hasColumn('products','is_virtual')){
                $table->tinyInteger('is_virtual')->nullable()->default(0);
            }
        });
        Schema::table('product_variations',function (Blueprint $table){
            if(!Schema::hasColumn('product_variations','variation_type')){
                $table->tinyInteger('variation_type')->nullable()->default(0);
                $table->bigInteger('vendor_id')->nullable();
                $table->bigInteger('parent_id')->nullable();
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
    }
};
