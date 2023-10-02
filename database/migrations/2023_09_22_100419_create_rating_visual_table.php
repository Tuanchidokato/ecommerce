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
        Schema::create('rating_visual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('star_rating_id');
            $table->string('image_url');
            $table->enum('type',['VIDEO','IMAGE']);
            $table->string('url');
            $table->foreign('star_rating_id')->references('id')->on('products_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_visual');
    }
};
