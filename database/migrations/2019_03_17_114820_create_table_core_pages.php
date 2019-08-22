<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Database\Schema\Blueprint;

class CreateTableCorePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_pages', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug',255)->charset('utf8')->index();
            $table->string('title',255)->nullable();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('template_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('bravo_attrs', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('service',50)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bravo_terms', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();
            $table->integer('attr_id')->nullable();
            $table->string('slug',255)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->softDeletes();
            $table->integer('image_id')->nullable();


            $table->timestamps();
        });

        $this->createTranslationTables();
    }


    public function createTranslationTables(){

        Schema::create('core_page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title',255)->nullable();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->unique(['origin_id', 'locale']);

            $table->timestamps();
        });

        Schema::create('core_news_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title',255)->nullable();
            $table->text('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('core_news_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('core_tag_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('core_menu_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->longText('items')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });
        Schema::create('core_template_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title',255)->nullable();
            $table->longText('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('bravo_attrs_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('name',255)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->unique(['origin_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('bravo_terms_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->unique(['origin_id', 'locale']);
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
        Schema::dropIfExists('core_pages');
        Schema::dropIfExists('bravo_attrs');
        Schema::dropIfExists('bravo_terms');

        Schema::dropIfExists('core_page_translations');
        Schema::dropIfExists('core_news_translations');
        Schema::dropIfExists('core_news_category_translations');
        Schema::dropIfExists('core_tag_translations');
        Schema::dropIfExists('core_menu_translations');
        Schema::dropIfExists('core_template_translations');
        Schema::dropIfExists('bravo_attrs_translations');
        Schema::dropIfExists('bravo_terms_translations');
    }
}
