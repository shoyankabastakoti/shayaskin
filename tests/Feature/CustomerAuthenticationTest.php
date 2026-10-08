<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustomerAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_storefront_header_shows_register_and_login_next_to_search(): void
    {
        $this->get(route('home'))
            ->assertSee(route('register'), false)
            ->assertSee(route('login'), false)
            ->assertSee('Register')
            ->assertSee('Login');
    }

    public function test_guest_can_view_customer_login_and_registration_forms(): void
    {
        $this->get(route('login'))
            ->assertSee('Sign in to your Shaya Skin customer account.')
            ->assertSee(route('register'), false);

        $this->get(route('register'))
            ->assertSee('Create an account')
            ->assertSee(route('login'), false);
    }

    public function test_authenticated_admin_can_open_customer_login_and_registration_forms(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $this->actingAs($admin)
            ->get(route('register'))
            ->assertSee('Create an account');

        $this->assertAuthenticatedAs($admin);

        $this->get(route('login'))
            ->assertSee('Sign in to your Shaya Skin customer account.');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_customer_can_register_with_a_hashed_password_and_is_logged_in(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'New Customer',
            'email' => '  NEW.CUSTOMER@EXAMPLE.COM ',
            'password' => 'a-strong-customer-password',
            'password_confirmation' => 'a-strong-customer-password',
            'is_admin' => true,
        ]);

        $response->assertRedirect(route('home'));
        $customer = User::query()->where('email', 'new.customer@example.com')->firstOrFail();
        $this->assertModelExists($customer);
        $this->assertAuthenticatedAs($customer);
        $this->assertFalse($customer->is_admin);
        $this->assertTrue(Hash::check('a-strong-customer-password', $customer->password));
    }

    public function test_registration_rejects_duplicate_email_and_short_password(): void
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $this->from(route('register'))
            ->post(route('register.store'), [
                'name' => 'New Customer',
                'email' => 'TAKEN@example.com',
                'password' => 'short',
                'password_confirmation' => 'short',
            ])
            ->assertRedirect(route('register'))
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }

    public function test_customer_can_login_and_logout(): void
    {
        $customer = User::factory()->create([
            'email' => 'customer@example.com',
            'password' => Hash::make('customer-password'),
        ]);

        $this->post(route('login.store'), [
            'email' => ' CUSTOMER@EXAMPLE.COM ',
            'password' => 'customer-password',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($customer);

        $this->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_invalid_credentials_and_admin_credentials_cannot_log_in_as_a_customer(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin-password'),
        ]);
        $admin->forceFill(['is_admin' => true])->save();

        $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => 'customer@example.com',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->post(route('login.store'), [
            'email' => 'admin@example.com',
            'password' => 'admin-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
