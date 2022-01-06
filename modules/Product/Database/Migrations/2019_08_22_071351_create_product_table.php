<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku',255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->integer('image_id')->nullable();
            $table->integer('banner_image_id')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->tinyInteger('is_featured')->nullable();
            $table->integer('shipping_class')->nullable();

            $table->string('gallery', 255)->nullable();
            $table->string('video', 255)->nullable();

            //Price
            $table->decimal('price', 12,2)->nullable();
            $table->decimal('sale_price', 12,2)->nullable();
            $table->decimal('origin_price', 12,2)->nullable();

            //Extra Info
            $table->string('status',50)->nullable();
            $table->text('attributes_for_variation')->nullable();
//            $table->tinyInteger('enable_review')->nullable();

            $table->decimal('weight',5,2)->nullable();
            $table->decimal('length',5,2)->nullable();
            $table->decimal('width',5,2)->nullable();
            $table->decimal('height',5,2)->nullable();

            // Stock
            $table->tinyInteger('sold')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->tinyInteger('is_manage_stock')->nullable();
            $table->string('stock_status',20)->nullable();


            $table->string('product_type',30)->nullable();

            //review
            $table->decimal('review_score',2,1)->nullable();
            //External
            $table->string('external_url')->nullable();
            $table->string('button_text')->nullable();

            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->nullable();
            $table->text('content')->nullable();
            $table->string('slug',255)->nullable();
            $table->string('status',50)->nullable();
            $table->integer('image_id')->nullable();
            $table->string('icon',50)->nullable();
            $table->nestedSet();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });


        Schema::create('product_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('name',255)->nullable();
            $table->text('content')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->unique(['origin_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('product_term', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('term_id')->nullable();
            $table->integer('target_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });
        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('product_id')->nullable();
            $table->integer('shipping_class')->nullable();
            $table->string('name',255)->nullable();
            $table->tinyInteger('position')->nullable();
            $table->string('sku',255)->nullable();
            $table->integer('image_id')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->tinyInteger('sold')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->tinyInteger('is_manage_stock')->nullable();
            $table->string('stock_status',20)->nullable();

            // Extra
            $table->decimal('weight',5,2)->nullable();
            $table->decimal('length',5,2)->nullable();
            $table->decimal('width',5,2)->nullable();
            $table->decimal('height',5,2)->nullable();

            $table->tinyInteger('active')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });
        Schema::create('product_variation_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('variation_id')->nullable();
            $table->string('name',255)->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });
        Schema::create('product_variation_term', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('product_id')->nullable();
            $table->integer('variation_id')->nullable();
            $table->integer('term_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });
        Schema::create('product_tag', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('tag_id')->nullable();
            $table->integer('target_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });

        Schema::create('product_category_relations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('cat_id')->nullable();
            $table->integer('target_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();

        });

	    Schema::create('product_brand', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->string('name',255)->nullable();
		    $table->text('content')->nullable();
		    $table->string('slug',255)->nullable();
		    $table->string('status',50)->nullable();
		    $table->integer('image_id')->nullable();
		    $table->string('icon',50)->nullable();

		    $table->integer('create_user')->nullable();
		    $table->integer('update_user')->nullable();

		    $table->timestamps();
	    });

	    Schema::create('product_brand_translations', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('origin_id')->nullable();
		    $table->string('locale',10)->nullable();

		    $table->string('name',255)->nullable();
		    $table->text('content')->nullable();

		    $table->integer('create_user')->nullable();
		    $table->integer('update_user')->nullable();
		    $table->unique(['origin_id', 'locale']);
		    $table->timestamps();
	    });

	    Schema::create('user_address', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('user_id')->nullable()->index();

		    $table->string('first_name')->nullable();
		    $table->string('last_name')->nullable();
		    $table->string('company')->nullable();
		    $table->string('address')->nullable();
		    $table->string('address2')->nullable();
		    $table->string('city')->nullable();
		    $table->string('state')->nullable();
		    $table->string('postcode')->nullable();
		    $table->string('country',30)->nullable();
		    $table->string('email')->nullable();
		    $table->string('phone')->nullable();

		    $table->tinyInteger('type')->nullable()->default(1)->comment('1: Billing, 2: Shipping');
		    $table->tinyInteger('is_default')->nullable()->default(0);
		    $table->integer('create_user')->nullable();
		    $table->integer('update_user')->nullable();

		    $table->timestamps();
	    });

        Schema::create('product_shipping_zones', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('order')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_shipping_zone_locations', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('zone_id')->nullable();

            $table->string('location_code')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();

            $table->timestamps();
        });

        Schema::create('product_sz_methods', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title', 255)->nullable();
            $table->bigInteger('zone_id')->nullable();
            $table->string('method_id')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('is_enabled')->nullable();

            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('product_sz_method_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            $table->string('title',255)->nullable();

            $table->unique(['origin_id', 'locale'],'origin_locale');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('product_category_relations');
        Schema::dropIfExists('product_category_translations');
        Schema::dropIfExists('product_term');
        Schema::dropIfExists('product_tag');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_variation_term');
        Schema::dropIfExists('product_variation_translations');
        Schema::dropIfExists('product_brand');
        Schema::dropIfExists('product_brand_translations');
        Schema::dropIfExists('product_shipping_zones');
        Schema::dropIfExists('product_shipping_zone_locations');
        Schema::dropIfExists('product_sz_methods');
        Schema::dropIfExists('product_sz_method_translations');

        Schema::dropIfExists('user_address');
    }
}
