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
        Schema::create('locations', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->text('content')->nullable();
            $table->string('slug')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('map_lat',20)->nullable();
            $table->string('map_lng',20)->nullable();
            $table->integer('map_zoom')->nullable();
            $table->string('status',50)->nullable();
            $table->nestedSet();

            $table->tinyInteger('location_type')->nullable()->default(0)->comment('0: warehouse');

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->unique('slug');
            $table->timestamps();
        });

        Schema::create('location_translations', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('name')->nullable();
            $table->text('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->unique(['origin_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('location_product_stocks', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('variation_id')->nullable();

            $table->tinyInteger('stock_type')->nullable()->default(0)->comment('0: for product, 1 for variation');

            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('price',12,2)->nullable()->default(0);

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['product_id']);
            $table->index(['location_id','product_id']);

            $table->timestamps();
        });

        Schema::create('location_order_logs', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('order_item_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('variation_id')->nullable();

            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('price',12,2)->nullable()->default(0);

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['order_item_id']);
            $table->index(['location_id','product_id']);

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
        Schema::dropIfExists('locations');
        Schema::dropIfExists('location_translations');
        Schema::dropIfExists('location_product_stocks');
        Schema::dropIfExists('location_order_logs');
    }
};
