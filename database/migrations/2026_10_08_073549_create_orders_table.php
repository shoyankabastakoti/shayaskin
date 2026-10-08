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
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->string('order_number', 32)->unique();
            $table->string('customer_name');
            $table->string('customer_email')->index();
            $table->string('customer_phone', 40);
            $table->string('province', 100);
            $table->string('district', 100);
            $table->string('city', 100);
            $table->unsignedSmallInteger('ward')->nullable();
            $table->string('address', 500);
            $table->text('instructions')->nullable();
            $table->string('payment_method', 40)->default('cash_on_delivery');
            $table->string('status', 24)->default('pending')->index();
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('delivery_fee');
            $table->unsignedInteger('total_amount');
            $table->timestamps();

            $table->index(['created_at', 'status']);
        });

        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('brand');
            $table->string('image');
            $table->unsignedInteger('unit_price');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('line_total');
            $table->timestamps();

            $table->index(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
