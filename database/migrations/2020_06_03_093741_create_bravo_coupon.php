<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bc_coupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name','100')->nullable();
            $table->string('coupon_type','20')->nullable();
            $table->integer('discount')->nullable();
            $table->string('expiration')->nullable();
            $table->text('email')->nullable();
            $table->integer('usage')->nullable();
            $table->string('customer_id')->nullable();
            $table->integer('per_coupon')->nullable();
            $table->integer('per_user')->nullable();
            $table->string('status','10')->nullable();
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
        Schema::dropIfExists('bc_coupon');
    }
}
