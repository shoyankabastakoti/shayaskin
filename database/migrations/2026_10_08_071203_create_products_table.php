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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->string('category', 32);
            $table->string('skin_type', 32);
            $table->string('image');
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('reviews')->default(0);
            $table->text('ingredients')->nullable();
            $table->text('how_to_use')->nullable();
            $table->text('benefits')->nullable();
            $table->timestamps();

            $table->index(['category', 'skin_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
