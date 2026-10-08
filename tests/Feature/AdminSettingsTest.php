<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_admin_can_view_separate_settings_pages_and_sidebar_dropdown(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->get(route('admin.settings.password.edit'))
            ->assertSee('Change password')
            ->assertSee(route('admin.settings.password.edit'), false)
            ->assertSee(route('admin.settings.admins.create'), false)
            ->assertDontSee('Create an admin</h1>');

        $this->get(route('admin.settings.admins.create'))
            ->assertSee('Create an admin')
            ->assertSee('id="name"', false)
            ->assertDontSee('Change password</h1>');
    }

    public function test_admin_can_change_password_after_confirming_current_password(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->patch(route('admin.settings.password.update'), [
                'current_password' => 'password',
                'password' => 'a-strong-new-admin-password',
                'password_confirmation' => 'a-strong-new-admin-password',
            ]);

        $response->assertRedirect(route('admin.settings.password.edit'));
        $response->assertSessionHas('status', 'Your password was changed successfully.');
        $this->assertAuthenticatedAs($admin);
        $this->assertTrue(Hash::check('a-strong-new-admin-password', $admin->fresh()->password));
    }

    public function test_admin_cannot_change_password_with_an_incorrect_current_password(): void
    {
        $admin = $this->createAdmin();
        $originalPassword = $admin->password;

        $this->actingAs($admin)
            ->from(route('admin.settings.password.edit'))
            ->patch(route('admin.settings.password.update'), [
                'current_password' => 'incorrect-password',
                'password' => 'a-strong-new-admin-password',
                'password_confirmation' => 'a-strong-new-admin-password',
            ])
            ->assertRedirect(route('admin.settings.password.edit'))
            ->assertSessionHasErrors('current_password');

        $this->assertSame($originalPassword, $admin->fresh()->password);
    }

    public function test_admin_can_create_another_admin_with_a_hashed_password(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->post(route('admin.settings.admins.store'), [
                'name' => 'Second Admin',
                'email' => '  NEW.ADMIN@EXAMPLE.COM ',
                'password' => 'a-strong-admin-password',
                'password_confirmation' => 'a-strong-admin-password',
            ]);

        $response->assertRedirect(route('admin.settings.admins.create'));

        $newAdmin = User::query()->where('email', 'new.admin@example.com')->firstOrFail();
        $this->assertModelExists($newAdmin);
        $this->assertTrue($newAdmin->is_admin);
        $this->assertTrue(Hash::check('a-strong-admin-password', $newAdmin->password));
        $this->assertNotSame('a-strong-admin-password', $newAdmin->password);
    }

    public function test_admin_creation_rejects_a_duplicate_email(): void
    {
        $admin = $this->createAdmin();
        User::factory()->create(['email' => 'existing@example.com']);

        $this->actingAs($admin)
            ->from(route('admin.settings.admins.create'))
            ->post(route('admin.settings.admins.store'), [
                'name' => 'Duplicate Admin',
                'email' => 'EXISTING@example.com',
                'password' => 'a-strong-admin-password',
                'password_confirmation' => 'a-strong-admin-password',
                'settings_action' => 'admin',
            ])
            ->assertRedirect(route('admin.settings.admins.create'))
            ->assertSessionHasErrors('email');

        $this->get(route('admin.settings.admins.create'))
            ->assertSee('Create an admin')
            ->assertSee('value="existing@example.com"', false);

        $this->assertDatabaseCount('users', 2);
    }

    public function test_non_admin_cannot_access_or_use_admin_settings(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.settings.password.edit'))
            ->assertForbidden();

        $this->get(route('admin.settings.admins.create'))
            ->assertForbidden();

        $this->post(route('admin.settings.admins.store'), [
            'name' => 'Unauthorized Admin',
            'email' => 'new.admin@example.com',
            'password' => 'a-strong-admin-password',
            'password_confirmation' => 'a-strong-admin-password',
        ])->assertForbidden();

        $this->assertDatabaseMissing('users', ['email' => 'new.admin@example.com']);
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
