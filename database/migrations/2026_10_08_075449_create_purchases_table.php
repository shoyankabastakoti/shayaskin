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
        Schema::create('purchases', function (Blueprint $table): void {
            $table->id();
            $table->string('purchase_number', 40)->unique();
            $table->string('supplier_name');
            $table->string('supplier_email')->nullable();
            $table->string('supplier_phone', 40)->nullable();
            $table->string('supplier_reference', 100)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('total_amount');
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('purchase_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->unsignedInteger('unit_cost');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('line_total');
            $table->timestamps();

            $table->index(['purchase_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
        Schema::dropIfExists('purchases');
    }
};
