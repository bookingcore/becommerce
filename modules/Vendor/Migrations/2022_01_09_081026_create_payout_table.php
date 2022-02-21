<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('vendor_id')->index();
            $table->decimal('total',10,2)->nullable();
            $table->string('status',50)->nullable();
            $table->string("payout_method",50)->nullable();
            $table->text("account_info")->nullable();

            $table->smallInteger('month')->nullable();
            $table->smallInteger('year')->nullable();

            $table->text("note_to_admin")->nullable();
            $table->text("note_to_vendor")->nullable();
            $table->integer('last_process_by')->nullable();
            $table->timestamp("pay_date")->nullable();// admin pay date

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->index(['year','month']);

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('vendor_payout_accounts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('vendor_id')->index();
            $table->string("payout_method",50)->nullable();
            $table->text("account_info")->nullable();

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
        Schema::dropIfExists('vendor_payouts');
        Schema::dropIfExists('vendor_payout_accounts');
    }
}
