<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bc_orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('customer_id')->nullable();

            $table->decimal('subtotal',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->string('gateway',50)->nullable();
            $table->string('status',30)->nullable();
            $table->decimal('paid',10,2)->nullable();

            $table->text('billing')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bc_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('object_id')->nullable();
            $table->string('object_model',255)->nullable();

            $table->decimal('price',10,2)->nullable();
            $table->integer('qty')->default(1)->nullable();
            $table->decimal('subtotal',10,2)->nullable();

            $table->string('status',30)->nullable();

            $table->text('meta')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bc_order_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('order_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();


            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('bc_payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('object_id')->nullable();
            $table->string('object_model',30)->nullable();

            $table->string('gateway',50)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('currency',10)->nullable();

            $table->decimal('converted_amount',10,2)->nullable();
            $table->string('converted_currency',10)->nullable();
            $table->decimal('exchange_rate',10,2)->nullable();

            $table->string('status',30)->nullable();
            $table->text('logs')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('bc_payment_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('payment_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();


            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });



//	    Schema::create('product_orders', function (Blueprint $table) {
//		    $table->bigIncrements('id');
//		    $table->string('code',64)->nullable()->unique();
//
//		    $table->integer('payment_id')->nullable();
//		    $table->string('gateway',50)->nullable();
//		    $table->bigInteger('customer_id')->nullable();
//
//		    $table->decimal('total',10,2)->nullable();
//		    $table->decimal('final_total',10,2)->nullable();
//		    $table->text('coupons')->nullable();
//		    $table->string('currency',20)->nullable();
//		    $table->string('status',30)->nullable();
//
//		    $table->decimal('total_before_fees',10,2)->nullable();
//		    $table->decimal('total_before_tax',10,2)->nullable();
//		    $table->decimal('tax_amount',10,2)->nullable();
//
//		    $table->string('email',255)->nullable();
//		    $table->string('first_name',255)->nullable();
//		    $table->string('last_name',255)->nullable();
//		    $table->string('phone',255)->nullable();
//		    $table->string('address',255)->nullable();
//		    $table->string('address2',255)->nullable();
//		    $table->string('city',255)->nullable();
//		    $table->string('state',255)->nullable();
//		    $table->string('postcode',255)->nullable();
//		    $table->string('country',255)->nullable();
//		    $table->string('company',255)->nullable();
//
//
//		    $table->string('shipping_first_name',255)->nullable();
//		    $table->string('shipping_last_name',255)->nullable();
//		    $table->string('shipping_address',255)->nullable();
//		    $table->string('shipping_address2',255)->nullable();
//		    $table->string('shipping_city',255)->nullable();
//		    $table->string('shipping_state',255)->nullable();
//		    $table->string('shipping_postcode',255)->nullable();
//		    $table->string('shipping_country',255)->nullable();
//		    $table->string('shipping_company',255)->nullable();
//
//		    $table->text('customer_notes')->nullable();
//
//		    $table->string('payment_gateway',30)->nullable();
//
//
//		    $table->integer('create_user')->nullable();
//		    $table->integer('update_user')->nullable();
//
//		    $table->timestamps();
//		    $table->softDeletes();
//	    });
//
//	    Schema::create('product_order_payments', function (Blueprint $table) {
//		    $table->bigIncrements('id');
//
//		    $table->integer('order_id')->nullable();
//		    $table->string('payment_gateway',50)->nullable();
//
//		    $table->decimal('amount',10,2)->nullable();
//		    $table->string('currency',20)->nullable();
//
//		    $table->decimal('converted_amount',10,2)->nullable();
//		    $table->string('converted_currency',10)->nullable();
//		    $table->decimal('exchange_rate',10,2)->nullable();
//
//		    $table->string('status',30)->nullable();
//		    $table->text('logs')->nullable();
//
//		    $table->integer('create_user')->nullable();
//		    $table->integer('update_user')->nullable();
//
//		    $table->timestamps();
//	    });
//
//	    Schema::create('product_order_items', function (Blueprint $table) {
//		    $table->bigIncrements('id');
//
//		    $table->integer('order_id')->nullable();
//		    $table->integer('vendor_id')->nullable();
//		    $table->integer('customer_id')->nullable();
//		    $table->integer('product_id')->nullable();
//		    $table->string('product_name',255)->nullable();
//		    $table->string('type',20)->nullable();
//		    $table->integer('qty')->nullable();
//		    $table->decimal('price')->nullable();
//		    $table->decimal('subtotal')->nullable();
//
//		    $table->decimal('commission',10,2)->nullable();
//		    $table->string('commission_type',30)->nullable();
//
//
//		    $table->integer('create_user')->nullable();
//		    $table->integer('update_user')->nullable();
//
//		    $table->timestamps();
//	    });
//
//	    Schema::create('product_order_item_meta', function (Blueprint $table) {
//		    $table->bigIncrements('id');
//
//		    $table->bigInteger('order_id')->nullable();
//		    $table->bigInteger('order_item_id')->nullable();
//
//		    $table->string('meta_key',100)->nullable();
//		    $table->text('meta_value')->nullable();
//
//		    $table->integer('create_user')->nullable();
//		    $table->integer('update_user')->nullable();
//
//		    $table->timestamps();
//	    });
//	    Schema::create('product_order_meta', function (Blueprint $table) {
//		    $table->bigIncrements('id');
//		    $table->bigInteger('order_id')->nullable();
//		    $table->string('meta_key',100)->nullable();
//		    $table->text('meta_value')->nullable();
//
//		    $table->integer('create_user')->nullable();
//		    $table->integer('update_user')->nullable();
//
//		    $table->timestamps();
//	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bc_orders');
        Schema::dropIfExists('bc_order_items');
        Schema::dropIfExists('bc_order_meta');
        Schema::dropIfExists('bc_payments');
        Schema::dropIfExists('bc_payment_meta');
    }
}
