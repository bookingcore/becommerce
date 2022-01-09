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
        Schema::create('core_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();

            $table->decimal('subtotal',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();
	        $table->string('currency',20)->nullable();
	        $table->bigInteger('payment_id')->nullable();
            $table->string('gateway',50)->nullable();
            $table->string('status',30)->nullable();
            $table->decimal('paid',10,2)->nullable();

		    $table->text('coupon')->nullable();

		    $table->decimal('total_before_fees',10,2)->nullable();
		    $table->decimal('total_before_tax',10,2)->nullable();
		    $table->decimal('tax_amount',10,2)->nullable();

            $table->decimal('commission_amount',10,2)->nullable();

		    $table->string('email',255)->nullable();
		    $table->string('first_name',255)->nullable();
		    $table->string('last_name',255)->nullable();
		    $table->string('phone',255)->nullable();
		    $table->string('billing_address',255)->nullable();
		    $table->string('billing_address2',255)->nullable();
		    $table->string('billing_city',255)->nullable();
		    $table->string('billing_state',255)->nullable();
		    $table->string('billing_postcode',255)->nullable();
		    $table->string('billing_country',255)->nullable();
		    $table->string('billing_company',255)->nullable();

	        $table->string('shipping_first_name',255)->nullable();
		    $table->string('shipping_last_name',255)->nullable();
		    $table->string('shipping_address',255)->nullable();
		    $table->string('shipping_address2',255)->nullable();
		    $table->string('shipping_city',255)->nullable();
		    $table->string('shipping_state',255)->nullable();
		    $table->string('shipping_postcode',255)->nullable();
		    $table->string('shipping_country',255)->nullable();
		    $table->string('shipping_company',255)->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['customer_id']);
            $table->index(['status']);

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('core_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('object_id')->nullable();
            $table->string('object_model',255)->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->bigInteger('payout_id')->nullable();

            $table->decimal('price',10,2)->nullable();
            $table->integer('qty')->default(1)->nullable();
            $table->decimal('subtotal',10,2)->nullable();

            $table->string('status',30)->nullable();

            $table->text('meta')->nullable();

            $table->decimal('commission_amount',10,2)->nullable();
            $table->decimal('tax_amount',10,2)->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['payout_id']);
            $table->index(['vendor_id']);
            $table->index(['order_id']);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('core_order_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['order_id','name']);
            $table->timestamps();
        });

        Schema::create('core_order_item_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_item_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['order_item_id','name']);
            $table->timestamps();
        });

        Schema::create('core_payments', function (Blueprint $table) {
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

        Schema::create('core_payment_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('payment_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['payment_id','name']);
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
        Schema::dropIfExists('core_orders');
        Schema::dropIfExists('core_order_items');
        Schema::dropIfExists('core_order_meta');
        Schema::dropIfExists('core_payments');
        Schema::dropIfExists('core_payment_meta');
    }
}
