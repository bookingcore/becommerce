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
            $table->string('business_name');
            $table->string('username',50)->unique();
            $table->string('first_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone',30)->nullable();
            $table->date('birthday')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->bigInteger('avatar_id')->nullable();
            $table->text('bio')->nullable();
            $table->string('status',20)->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->decimal('commission')->nullable();
            $table->string('commission_type',30)->nullable()->default('default');
            $table->string('locale',10)->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('stripe_customer_id')->nullable();


            $table->tinyInteger('need_update_pw')->nullable()->default(0);
            $table->string('verify_submit_status',20)->nullable();

            $table->index('role_id');

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

            $table->index(['user_id','name']);
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
