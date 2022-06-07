<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('name');
            $table->string('name_bn');
            $table->string('slug'); 
            $table->json('tags');
            $table->binary('banner');
            $table->string('banner_type');
            $table->binary('image');
            $table->string('image_type');
            $table->binary('icon')->nullable();
            $table->string('icon_type')->nullable();
            $table->string('order_no')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('categories');
    }
}
