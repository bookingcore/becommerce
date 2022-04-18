<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->string('discount_type',20)->nullable()->default('percent');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->string('policy',50)->nullable();
            $table->string('status',50)->nullable()->default('draft');
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('campaign_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->string('discount_type',20)->nullable();
            $table->tinyInteger('deducted')->nullable()->default(0);

            $table->string('status',50)->nullable()->default('pending');
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
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('campaign_products');
    }
}
