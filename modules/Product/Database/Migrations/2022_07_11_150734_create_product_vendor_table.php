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
        Schema::create('product_vendors', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->string('sku',255)->nullable();
            $table->integer('image_id')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->tinyInteger('sold')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->tinyInteger('is_manage_stock')->nullable();
            $table->string('stock_status',20)->nullable();

            $table->integer('sale_count')->nullable()->default(0);

            $table->tinyInteger('active')->nullable()->default(0);;
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->index(['product_id']);
            $table->index(['vendor_id']);

            $table->timestamps();
        });

        Schema::create('product_vendor_variations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->bigInteger('variation_id')->nullable();

            $table->string('sku',255)->nullable();
            $table->integer('image_id')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->tinyInteger('sold')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->tinyInteger('is_manage_stock')->nullable();
            $table->string('stock_status',20)->nullable();

            $table->integer('sale_count')->nullable()->default(0);

            $table->tinyInteger('active')->nullable()->default(0);
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->index(['vendor_id','variation_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_vendors');
        Schema::dropIfExists('product_vendor_variations');
    }
};
