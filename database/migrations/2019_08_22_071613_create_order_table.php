<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',64)->nullable()->unique();

            $table->integer('payment_id')->nullable();
            $table->string('gateway',50)->nullable();

            $table->decimal('total',10,2)->nullable();
            $table->string('currency',20)->nullable();
            $table->string('status',30)->nullable();

            $table->decimal('total_before_fees',10,2)->nullable();

            $table->decimal('deposit',10,2)->nullable();
            $table->string('deposit_type',30)->nullable();

            $table->decimal('commission',10,2)->nullable();
            $table->string('commission_type',30)->nullable();

            $table->string('email',255)->nullable();
            $table->string('first_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('address2',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('zip_code',255)->nullable();
            $table->string('country',255)->nullable();
            $table->text('customer_notes')->nullable();

            $table->string('payment_gateway',30)->nullable();


            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('order_id')->nullable();
            $table->string('payment_gateway',50)->nullable();

            $table->decimal('amount',10,2)->nullable();
            $table->string('currency',20)->nullable();

            $table->decimal('converted_amount',10,2)->nullable();
            $table->string('converted_currency',10)->nullable();
            $table->decimal('exchange_rate',10,2)->nullable();

            $table->string('status',30)->nullable();
            $table->text('logs')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('order_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('product_id')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_order_item_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('order_item_id')->nullable();

            $table->string('meta_key',100)->nullable();
            $table->text('meta_value')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });
        Schema::create('product_order_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->nullable();
            $table->string('meta_key',100)->nullable();
            $table->text('meta_value')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

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
        Schema::dropIfExists('product_orders');
        Schema::dropIfExists('product_order_meta');
        Schema::dropIfExists('product_order_payments');
        Schema::dropIfExists('product_order_items');
        Schema::dropIfExists('product_order_item_meta');
    }
}
