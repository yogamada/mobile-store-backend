<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $ani = User::create([
            'name' => 'Ani Konsumen',
            'email' => 'ani@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $budi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $citra = User::create([
            'name' => 'Citra Lestari',
            'email' => 'citra@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Deni Pratama',
            'email' => 'deni@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'konsumen1',
            'email' => 'konsumen@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // 2. Create Products
        $iphone = Product::create([
            'name' => 'iPhone 15 Pro Max',
            'brand' => 'Apple',
            'description' => 'The ultimate iPhone. Featuring a titanium design, the groundbreaking A17 Pro chip, a customizable Action button, and the most powerful iPhone camera system ever.',
            'price' => 19999000,
            'stock' => 10,
            'image_url' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500&auto=format&fit=crop&q=60',
        ]);

        $samsung = Product::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'brand' => 'Samsung',
            'description' => 'Welcome to the era of mobile AI. With Galaxy S24 Ultra in your hands, you can unleash whole new levels of creativity, productivity and possibility.',
            'price' => 21999000,
            'stock' => 12,
            'image_url' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500&auto=format&fit=crop&q=60',
        ]);

        $xiaomi = Product::create([
            'name' => 'Xiaomi 14',
            'brand' => 'Xiaomi',
            'description' => 'Co-engineered with Leica. Next-generation Leica Summilux optical lens, Snapdragon 8 Gen 3, and a stunning 120Hz AMOLED display.',
            'price' => 11999000,
            'stock' => 15,
            'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=60',
        ]);

        $airpods = Product::create([
            'name' => 'AirPods Pro Gen 2',
            'brand' => 'Apple',
            'description' => 'Up to 2x more Active Noise Cancellation. Adaptive Audio filters out noise you do not want to hear, while Transparency mode lets the world back in.',
            'price' => 3999000,
            'stock' => 20,
            'image_url' => 'https://images.unsplash.com/photo-1588449668365-d15e397f6787?w=500&auto=format&fit=crop&q=60',
        ]);

        $buds = Product::create([
            'name' => 'Galaxy Buds 2 Pro',
            'brand' => 'Samsung',
            'description' => 'Ultimate 24-bit Hi-Fi sound. Intelligent Active Noise Cancellation. Ergonomic fit for comfortable listening all day long.',
            'price' => 2799000,
            'stock' => 25,
            'image_url' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&auto=format&fit=crop&q=60',
        ]);

        // 3. Create Orders
        $order1 = Order::create([
            'user_id' => $ani->id,
            'total_amount' => $iphone->price + $airpods->price,
            'status' => 'completed',
        ]);
        $order1->created_at = now()->subDays(3);
        $order1->save();

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $iphone->id,
            'quantity' => 1,
            'price' => $iphone->price,
        ]);
        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $airpods->id,
            'quantity' => 1,
            'price' => $airpods->price,
        ]);

        $order2 = Order::create([
            'user_id' => $budi->id,
            'total_amount' => $samsung->price,
            'status' => 'completed',
        ]);
        $order2->created_at = now()->subDays(2);
        $order2->save();

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $samsung->id,
            'quantity' => 1,
            'price' => $samsung->price,
        ]);

        $order3 = Order::create([
            'user_id' => $citra->id,
            'total_amount' => $xiaomi->price + $buds->price,
            'status' => 'pending',
        ]);
        $order3->created_at = now()->subDay();
        $order3->save();

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $xiaomi->id,
            'quantity' => 1,
            'price' => $xiaomi->price,
        ]);
        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $buds->id,
            'quantity' => 1,
            'price' => $buds->price,
        ]);

        $order4 = Order::create([
            'user_id' => $ani->id,
            'total_amount' => $airpods->price,
            'status' => 'completed',
        ]);
        $order4->created_at = now()->subHours(5);
        $order4->save();

        OrderItem::create([
            'order_id' => $order4->id,
            'product_id' => $airpods->id,
            'quantity' => 1,
            'price' => $airpods->price,
        ]);

        $order5 = Order::create([
            'user_id' => $budi->id,
            'total_amount' => $iphone->price,
            'status' => 'cancelled',
        ]);
        $order5->created_at = now()->subHours(2);
        $order5->save();

        OrderItem::create([
            'order_id' => $order5->id,
            'product_id' => $iphone->id,
            'quantity' => 1,
            'price' => $iphone->price,
        ]);
    }
}
