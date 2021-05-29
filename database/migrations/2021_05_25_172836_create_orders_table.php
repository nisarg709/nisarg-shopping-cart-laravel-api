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
            $table->unsignedBigInteger('user_id')->unsigned()->index()->nullable()->comment('link to user table');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('product_id')->unsigned()->index()->nullable()->comment('link to product table');
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('order_number')->nullable();
            $table->integer('quantity');
            $table->string('sku',20);
            $table->float('amount', 8, 2);
            $table->float('shipping_fees', 8, 2);
            $table->enum('status',['in_cart','success','fail'])->default('in_cart');
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
