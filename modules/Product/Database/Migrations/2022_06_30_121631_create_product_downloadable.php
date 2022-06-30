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
        Schema::create('product_downloadable', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->nullable()->index();

            $table->bigInteger('file_id')->nullable();
            $table->string('file_name')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_download_logs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('download_id')->nullable()->index();
            $table->bigInteger('user_id')->nullable()->index();
            $table->string('ip_address',50)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

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
        Schema::dropIfExists('product_downloadable');
        Schema::dropIfExists('product_download_logs');
    }
};
