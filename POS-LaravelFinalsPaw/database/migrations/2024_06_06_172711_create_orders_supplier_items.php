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
        Schema::create('ordersupplier_items', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->integer('quantity')->default(1);
            $table->foreignId('ordersupplier_id');
            $table->foreignId('product_id');
            $table->timestamps();

            $table->foreign('ordersupplier_id')->references('id')->on('order_suppliers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordersupplier_items');
    }
};

