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
        Schema::create('course_section', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('course_id')->nullable();

            $table->string('name',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('service',50)->nullable();

            $table->string('display_type',255)->nullable();
            $table->tinyInteger('hide_in_single')->nullable();
            $table->tinyInteger('active')->default(1)->nullable();
            $table->tinyInteger('display_order')->default(0)->nullable();


            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('course_lessons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('section_id')->nullable();
            $table->integer('course_id')->nullable();

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('duration')->nullable();
            $table->string('slug',255)->nullable();
            $table->bigInteger('file_id')->nullable();
            $table->string('type',30)->nullable();
            $table->text('url')->nullable();
            $table->string('preview_url')->nullable();


            $table->tinyInteger('active')->default(1)->nullable();
            $table->tinyInteger('display_order')->default(0)->nullable();


            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('image_id')->nullable();
            $table->string('icon',50)->nullable();

            $table->index(['course_id','section_id']);

        });

        Schema::create('course_section_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('name',255)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->unique(['origin_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('course_lessons_translations', function (Blueprint $table) {
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


        Schema::create('course_lesson_completion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('lesson_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->tinyInteger('percent')->nullable();

            $table->index(['course_id','lesson_id','user_id']);
            $table->index(['course_id','user_id']);

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });

        Schema::create('course_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->bigInteger('order_id')->nullable();

            $table->softDeletes();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->unique(['course_id','user_id']);
            $table->timestamps();

        });

        Schema::create('course_user_completion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->tinyInteger('percent')->nullable();

            $table->index(['course_id','user_id']);

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });

        Schema::create('course_study_log', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('lesson_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->tinyInteger('percent')->nullable();

            $table->index(['course_id','lesson_id','user_id']);
            $table->index(['course_id','user_id']);

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
        Schema::dropIfExists('course_section');
        Schema::dropIfExists('course_lessons');
        Schema::dropIfExists('course_section_translations');
        Schema::dropIfExists('course_lessons_translations');
        Schema::dropIfExists('course_study_log');
        Schema::dropIfExists('course_user');
        Schema::dropIfExists('course_user_completion');
    }
};
