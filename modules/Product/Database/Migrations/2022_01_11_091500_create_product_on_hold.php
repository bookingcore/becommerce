<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOnHold extends Migration
{
	public function up()
	{
		Schema::create('product_on_hold', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->bigInteger('variant_id');
            $table->integer('qty');
            $table->dateTime('expired_at');
            $table->bigInteger('create_user')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('product_on_hold');
	}
}
