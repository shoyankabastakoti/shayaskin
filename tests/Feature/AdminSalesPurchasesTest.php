<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSalesPurchasesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_admin_can_record_a_supplier_purchase_and_product_stock_increases(): void
    {
        $admin = $this->createAdmin();
        $product = Product::factory()->create([
            'name' => 'Daily Glow Serum',
            'stock_quantity' => 5,
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.purchases.store'), [
                'supplier_name' => 'Beauty Wholesale',
                'supplier_email' => 'orders@beauty-wholesale.example',
                'supplier_phone' => '9800000000',
                'supplier_reference' => 'INV-2026-15',
                'items' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 8,
                        'unit_cost' => 700,
                    ],
                ],
            ]);

        $response->assertSessionHasNoErrors();
        $purchase = Purchase::query()->where('supplier_reference', 'INV-2026-15')->firstOrFail();
        $response->assertRedirect(route('admin.purchases.show', $purchase));
        $this->assertDatabaseHas('purchases', [
            'id' => $purchase->id,
            'supplier_name' => 'Beauty Wholesale',
            'total_amount' => 5600,
        ]);
        $this->assertDatabaseHas('purchase_items', [
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
            'product_name' => 'Daily Glow Serum',
            'unit_cost' => 700,
            'quantity' => 8,
            'line_total' => 5600,
        ]);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 13,
        ]);

        $this->get(route('admin.purchases.index'))
            ->assertSee('Beauty Wholesale')
            ->assertSee('5,600');
        $this->get(route('admin.purchases.show', $purchase))
            ->assertSee('Daily Glow Serum')
            ->assertSee('INV-2026-15');
    }

    public function test_invalid_supplier_purchase_does_not_create_purchase_or_change_stock(): void
    {
        $admin = $this->createAdmin();
        $product = Product::factory()->create(['stock_quantity' => 5]);

        $this->actingAs($admin)
            ->from(route('admin.purchases.create'))
            ->post(route('admin.purchases.store'), [
                'supplier_name' => 'Beauty Wholesale',
                'items' => [
                    [
                        'product_id' => $product->id,
                        'quantity' => 8,
                        'unit_cost' => 700,
                    ],
                    [
                        'product_id' => $product->id,
                        'quantity' => 2,
                        'unit_cost' => 700,
                    ],
                ],
            ])
            ->assertRedirect(route('admin.purchases.create'))
            ->assertSessionHasErrors('items.1.product_id');

        $this->assertDatabaseCount('purchases', 0);
        $this->assertDatabaseCount('purchase_items', 0);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 5,
        ]);
    }

    public function test_admin_can_open_supplier_purchase_form(): void
    {
        $admin = $this->createAdmin();
        Product::factory()->create(['name' => 'Daily Glow Serum']);

        $this->actingAs($admin)
            ->get(route('admin.purchases.create'))
            ->assertSee('Record purchase')
            ->assertSee('Daily Glow Serum')
            ->assertSee('Record purchase and add stock');
    }

    public function test_admin_sales_report_excludes_cancelled_orders_and_filters_dates(): void
    {
        $admin = $this->createAdmin();
        Order::factory()->create([
            'order_number' => 'SHY-PAID-001',
            'status' => 'delivered',
            'total_amount' => 2500,
            'created_at' => now()->subDays(2),
        ]);
        Order::factory()->create([
            'order_number' => 'SHY-PENDING-001',
            'status' => 'pending',
            'total_amount' => 1500,
            'created_at' => now()->subDays(2),
        ]);
        Order::factory()->create([
            'order_number' => 'SHY-CANCELLED-001',
            'status' => 'cancelled',
            'total_amount' => 9000,
            'created_at' => now()->subDays(2),
        ]);
        Order::factory()->create([
            'order_number' => 'SHY-OUTSIDE-001',
            'status' => 'delivered',
            'total_amount' => 5000,
            'created_at' => now()->subDays(40),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.sales.index', [
                'start_date' => now()->subDays(3)->toDateString(),
                'end_date' => now()->toDateString(),
            ]))
            ->assertSee('Rs. 4,000')
            ->assertSee('Customer orders')
            ->assertDontSee('SHY-CANCELLED-001')
            ->assertDontSee('SHY-OUTSIDE-001');
    }

    public function test_sales_report_rejects_an_end_date_before_the_start_date(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->from(route('admin.sales.index'))
            ->get(route('admin.sales.index', [
                'start_date' => '2026-10-10',
                'end_date' => '2026-10-09',
            ]))
            ->assertRedirect(route('admin.sales.index'))
            ->assertSessionHasErrors('end_date');
    }

    public function test_non_admin_cannot_view_sales_or_record_supplier_purchases(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.sales.index'))
            ->assertForbidden();

        $this->get(route('admin.purchases.index'))
            ->assertForbidden();

        $this->post(route('admin.purchases.store'), [])
            ->assertForbidden();

        $this->assertDatabaseCount('purchases', 0);
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
