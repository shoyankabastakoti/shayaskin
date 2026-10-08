<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_guest_is_redirected_to_admin_sign_in(): void
    {
        $this->get(route('admin.products.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_sign_in_and_sign_out(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.products.index'));

        $this->assertAuthenticatedAs($admin);

        $this->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }

    public function test_regular_user_cannot_sign_in_to_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_non_admin_is_forbidden_from_product_management(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.products.index'))
            ->assertForbidden();
    }

    public function test_admin_navigation_shows_users_without_customer_auth_links(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertSee(route('admin.customers.index'), false)
            ->assertSee('Users')
            ->assertDontSee(route('register'), false)
            ->assertDontSee(route('login'), false)
            ->assertDontSee('>Register</a>', false)
            ->assertDontSee('>Login</a>', false);
    }
}
