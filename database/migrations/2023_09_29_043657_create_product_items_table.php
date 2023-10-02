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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id(); // Cột ID tự động tạo
            $table->decimal('price', 10, 2); // Cột giá với 2 số thập phân
            $table->integer('quantity'); // Cột số lượng
            $table->enum('status', ['available', 'out_of_stock']); // Cột trạng thái (có thể chỉnh sửa giá trị enum)
            $table->string('title'); // Cột tiêu đề
            $table->timestamps(); // Cột created_at và updated_at tự động tạo
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
