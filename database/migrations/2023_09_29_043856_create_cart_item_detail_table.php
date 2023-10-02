<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_item_detail', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('cart_item_id');
            $table->foreign('cart_item_id')->references('id')->on('cart_items');
            $table->foreignId('product_option_detail_id');
            $table->foreign('product_option_detail_id')->references('id')->on('product_option_detail');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cart_item_detail');

    }
};
