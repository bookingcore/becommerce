<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('first_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address',255)->nullable();
            $table->string('address2',255)->nullable();
            $table->string('phone',30)->nullable();
            $table->date('birthday')->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('country',255)->nullable();
            $table->integer('postcode')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->bigInteger('avatar_id')->nullable();
            $table->text('bio')->nullable();
            $table->string('status',20)->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->integer('vendor_commission_amount')->nullable();
            $table->string('vendor_commission_type',30)->nullable();
            $table->string('locale',10)->nullable();
            $table->string('company',255)->nullable();


            $table->string('shipping_first_name',255)->nullable();
            $table->string('shipping_last_name',255)->nullable();
            $table->string('shipping_address',255)->nullable();
            $table->string('shipping_address2',255)->nullable();
            $table->string('shipping_city',255)->nullable();
            $table->string('shipping_country',255)->nullable();
            $table->integer('shipping_postcode')->nullable();
            $table->string('shipping_company',255)->nullable();


            $table->tinyInteger('need_update_pw')->default(0);

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        if (!Schema::hasTable('user_wishlist')) {
            Schema::create('user_wishlist', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('object_id')->nullable();
                $table->string('object_model', 255)->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->timestamps();
            });
        }

        Schema::create('user_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('name',255)->nullable();
            $table->text('val')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_wishlist');
        Schema::dropIfExists('user_meta');
    }
}
