<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreOrderManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_admin_customer_directory_lists_registered_accounts_with_roles_and_search(): void
    {
        $admin = User::factory()->create([
            'name' => 'Store Admin',
            'email' => 'store-admin@example.com',
        ]);
        $admin->forceFill(['is_admin' => true])->save();
        User::factory()->create([
            'name' => 'Registered Customer',
            'email' => 'registered@example.com',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.customers.index'))
            ->assertSee('Total users')
            ->assertSee('Admins')
            ->assertSee('Customers')
            ->assertSee('Registered users')
            ->assertSee('Store Admin')
            ->assertSee('Registered Customer')
            ->assertSee('Admin')
            ->assertSee('Customer');

        $this->get(route('admin.customers.index', ['q' => 'registered@example.com']))
            ->assertSee('Registered Customer')
            ->assertDontSee('Store Admin');
    }

    public function test_checkout_creates_a_persistent_order_using_database_product_prices(): void
    {
        $product = Product::factory()->create([
            'name' => 'Daily Glow Serum',
            'brand' => 'Shaya Skin',
            'price' => 2400,
            'image' => '/images/skincare1.jpg',
        ]);

        $response = $this->from(route('checkout'))->post(route('checkout.submit'), [
            'name' => 'Asha Customer',
            'phone' => '9800000000',
            'email' => 'asha@example.com',
            'province' => 'Bagmati',
            'district' => 'Kathmandu',
            'city' => 'Kathmandu',
            'ward' => 4,
            'address' => 'Thamel',
            'payment' => 'esewa',
            'total_amount' => 1,
            'cart_data' => json_encode([[
                'id' => $product->id,
                'name' => 'Tampered name',
                'price' => 1,
                'quantity' => 2,
            ]], JSON_THROW_ON_ERROR),
        ]);

        $order = Order::query()->where('customer_email', 'asha@example.com')->firstOrFail();
        $response->assertRedirect(route('confirmation'));
        $response->assertSessionHas('last_order_id', $order->id);
        $this->assertModelExists($order);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'subtotal' => 4800,
            'delivery_fee' => 150,
            'total_amount' => 4950,
            'payment_method' => 'cash_on_delivery',
            'status' => 'pending',
        ]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => 'Daily Glow Serum',
            'unit_price' => 2400,
            'quantity' => 2,
            'line_total' => 4800,
        ]);

        $this->get(route('confirmation'))->assertSee($order->order_number);
    }

    public function test_checkout_rejects_invalid_cart_without_creating_an_order(): void
    {
        $response = $this->from(route('checkout'))->post(route('checkout.submit'), [
            'name' => 'Asha Customer',
            'phone' => '9800000000',
            'email' => 'asha@example.com',
            'province' => 'Bagmati',
            'district' => 'Kathmandu',
            'city' => 'Kathmandu',
            'address' => 'Thamel',
            'cart_data' => json_encode([['id' => 999, 'quantity' => 1]], JSON_THROW_ON_ERROR),
        ]);

        $response->assertRedirect(route('checkout'));
        $response->assertSessionHasErrors('cart_data');
        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);
    }

    public function test_admin_can_view_dashboard_orders_and_checkout_customers(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();
        $order = Order::factory()->create([
            'customer_name' => 'Asha Customer',
            'customer_email' => 'asha@example.com',
            'total_amount' => 2150,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee($order->order_number)
            ->assertSee('Rs. 2,150');

        $this->get(route('admin.orders.index'))
            ->assertOk()
            ->assertSee('asha@example.com');

        $this->get(route('admin.orders.show', $order))
            ->assertOk()
            ->assertSee($order->order_number)
            ->assertSee('Delivery address');

        $this->get(route('admin.customers.index'))
            ->assertOk()
            ->assertSee('Asha Customer')
            ->assertSee('asha@example.com');
    }

    public function test_admin_can_update_order_status_and_invalid_status_is_rejected(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();
        $order = Order::factory()->create();

        $this->actingAs($admin)
            ->patch(route('admin.orders.update', $order), ['status' => 'shipped'])
            ->assertRedirect(route('admin.orders.show', $order));

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
        ]);

        $this->patch(route('admin.orders.update', $order), ['status' => 'refunded'])
            ->assertSessionHasErrors('status');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
        ]);
    }

    public function test_non_admin_cannot_view_customer_or_order_data(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.customers.index'))
            ->assertForbidden();

        $this->get(route('admin.orders.show', $order))
            ->assertForbidden();
    }
}
