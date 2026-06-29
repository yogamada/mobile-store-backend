<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class SystemFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Set up default users
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ani Konsumen',
            'email' => 'ani@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Create sample product
        Product::create([
            'name' => 'iPhone 15 Pro Max',
            'brand' => 'Apple',
            'price' => 19999000,
            'stock' => 10,
        ]);
    }

    public function test_api_login_validation(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'invalid@toko.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Unauthorized: Invalid email or password'
                 ]);
    }

    public function test_api_login_success(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'ani@toko.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'access_token',
                     'token_type',
                     'expires_in',
                     'user' => ['id', 'name', 'email', 'role']
                 ])
                 ->assertJson([
                     'success' => true,
                     'user' => [
                         'email' => 'ani@toko.com',
                         'role' => 'customer'
                     ]
                 ]);
    }

    public function test_customer_can_checkout(): void
    {
        $customer = User::where('role', 'customer')->first();
        $product = Product::first();
        $token = JWTAuth::fromUser($customer);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/orders', [
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2
                ]
            ]
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Checkout successful'
                 ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $customer->id,
            'total_amount' => 19999000 * 2,
            'status' => 'completed'
        ]);

        // Verify stock is decremented
        $product->refresh();
        $this->assertEquals(8, $product->stock);
    }

    public function test_admin_dashboard_requires_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }
}
