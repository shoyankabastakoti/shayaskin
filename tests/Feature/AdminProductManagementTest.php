<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_admin_can_create_product_with_uploaded_image(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();
        $image = UploadedFile::fake()->image('serum.jpg');

        $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Daily Glow Serum',
            'brand' => 'Shaya Skin',
            'description' => 'A hydrating daily serum.',
            'price' => 2400,
            'category' => 'skincare',
            'skin_type' => 'combination',
            'image' => $image,
            'rating' => 4.8,
            'reviews' => 25,
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::query()->where('name', 'Daily Glow Serum')->firstOrFail();
        $this->assertModelExists($product);
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $product->image));
        $this->assertSame(2400, $product->price);
    }

    public function test_admin_can_update_product_without_replacing_its_image(): void
    {
        $admin = $this->createAdmin();
        $product = Product::factory()->create([
            'name' => 'Old Serum',
            'image' => '/images/skincare3.jpg',
        ]);

        $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'name' => 'New Serum',
            'brand' => $product->brand,
            'description' => 'Updated product description.',
            'price' => 3100,
            'category' => 'skincare',
            'skin_type' => 'oily',
            'rating' => 4.5,
            'reviews' => 20,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Serum',
            'price' => 3100,
            'image' => '/images/skincare3.jpg',
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        $admin = $this->createAdmin();
        $product = Product::factory()->create();

        $this->actingAs($admin)->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_product_creation_rejects_unknown_category(): void
    {
        $admin = $this->createAdmin();
        Storage::fake('public');

        $this->actingAs($admin)->from(route('admin.products.create'))
            ->post(route('admin.products.store'), [
                'name' => 'Daily Glow Serum',
                'brand' => 'Shaya Skin',
                'description' => 'A hydrating daily serum.',
                'price' => 2400,
                'category' => 'unknown',
                'skin_type' => 'oily',
                'image' => UploadedFile::fake()->image('serum.jpg'),
            ])
            ->assertSessionHasErrors('category');

        $this->assertDatabaseMissing('products', ['name' => 'Daily Glow Serum']);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public function test_non_admin_cannot_create_products(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        $this->actingAs($user)
            ->post(route('admin.products.store'), [])
            ->assertForbidden();

        $this->assertDatabaseCount('products', 0);
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
