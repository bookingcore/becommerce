<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_review', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('object_id')->nullable();
            $table->string('object_model',255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->integer('rate_number')->nullable();
            $table->string('author_ip',100)->nullable();

            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->softDeletes();

            //Languages
            $table->string('lang',10)->nullable();

            $table->timestamps();
        });

        Schema::create('core_review_meta', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('review_id')->nullable();
            $table->integer('object_id')->nullable();
            $table->string('object_model',255)->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();

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
        Schema::dropIfExists('core_review');
        Schema::dropIfExists('core_review_meta');
    }
}
