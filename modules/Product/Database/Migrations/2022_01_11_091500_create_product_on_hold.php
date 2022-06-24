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
            $table->timestamp('expired_at')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->index(['order_id']);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('product_on_hold');
	}
}
