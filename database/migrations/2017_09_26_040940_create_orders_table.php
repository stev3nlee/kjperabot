<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id');
            $table->string('order_no',15);
            $table->string('billing_first_name',50);
            $table->string('billing_last_name',50);
            $table->string('billing_email');
            $table->string('billing_phone',50);
            $table->string('billing_province_id',100);
            $table->string('billing_jne_city_id',50);
            $table->string('billing_jne_city_label');
            $table->string('billing_post_code',10);
            $table->string('billing_address');
            $table->text('order_note')->nullable();
            $table->string('shipping_first_name',50);
            $table->string('shipping_last_name',50);
            $table->string('shipping_email');
            $table->string('shipping_phone',50);
            $table->string('shipping_province_id',100);
            $table->string('shipping_jne_city_id',50);
            $table->string('shipping_jne_city_label');
            $table->string('shipping_post_code',10);
            $table->string('shipping_address');
            $table->string('jne_shipping_method',50);
            $table->integer('order_status')->default('0');
            $table->integer('jne_shipping_value')->default('0');
            $table->varcher('jne_track',50)->nullable();
            $table->integer('tax_vat')->default('0');
            $table->integer('tax_value')->default('0');
            $table->integer('is_remindered')->default('0');
            $table->integer('is_deleted')->default('0');
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
        Schema::dropIfExists('orders');
    }
}
