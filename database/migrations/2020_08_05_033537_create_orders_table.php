<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('address_id');
            $table->json('product_id');
            $table->json('product_price');
            $table->float('total_price');
            $table->string('order_number');
            $table->string('invoice_number');
            $table->enum('order_status', ['Completed', 'Canceled', 'Processing', 'Delevered']);
            $table->enum('payment_status', ['Paid', 'Unpaid']);
            $table->string('payment_method');
            $table->dateTime('order_date');
            $table->dateTime('delivery_date');
            $table->bigInteger('discount_id');
            $table->bigInteger('coupon_id');
            $table->float('discount_amount');
            $table->float('delivery_charge');
            $table->bigInteger('delivery_man_id');
            $table->bigInteger('staff_id');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
