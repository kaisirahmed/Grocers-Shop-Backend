<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bn');
            $table->string('sub_name')->nullable();
            $table->string('sub_name_bn')->nullable();
            $table->string('slug');
            $table->string('slug_bn');
            $table->decimal('price', 8, 2);
            $table->string('price_bn', 10);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->string('sale_price_bn', 10)->nullable();
            $table->binary('image');
            $table->string('image_type');
            $table->text('description');
            $table->unsignedBigInteger('discount_amount')->nullable();
            $table->unsignedBigInteger('discount_percentage')->nullable();
            $table->string('special_offer')->nullable();
            $table->binary('special_image')->nullable();
            $table->string('special_image_type')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->boolean('status'); 
            $table->string('meta_title',75)->nullable();
            $table->string('meta_tags')->nullable();
            $table->text('meta_description',300)->nullable();
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
        Schema::dropIfExists('products');
    }
}
