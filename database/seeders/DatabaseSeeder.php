<?php

namespace Database\Seeders;

use App\Models\Amount;
use App\Models\Filter;
use App\Models\Order;
use App\Models\Product;
use App\Models\Specification;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Tony',
            'email' => 'admin@test.nl',
            'password' => bcrypt('12345678'),
            'admin' => true,
        ]);

        Specification::create([
            'cpu' => 'AMD Ryzen 7',
            'gpu' => 'RTX 3040',
            'ram' => '16gb',
        ]);

        Specification::create([
            'cpu' => 'Intel 3',
            'gpu' => 'none',
            'ram' => '8gb',
        ]);

        Product::create([
            'specification_id' => 1,
            'img' => 'laptop.jpg',
            'name' => 'ASUS Gaming 2023 PRO',
            'price' => 100,
            'description' => 'Dit is een voorbeeldproduct 1.',
        ]);

        Product::create([
            'specification_id' => 2,
            'img' => 'laptop.jpg',
            'name' => 'Linux laptop',
            'price' => 200,
            'description' => 'Dit is een voorbeeldproduct 2.',
        ]);

        Product::create([
            'specification_id' => 1,
            'img' => 'laptop.jpg',
            'name' => 'ASUS Gaming 2023 PRO 2',
            'price' => 100,
            'description' => 'Dit is een voorbeeldproduct 1.',
        ]);

        Product::create([
            'specification_id' => 2,
            'img' => 'laptop.jpg',
            'name' => 'Linux laptop 2',
            'price' => 200,
            'description' => 'Dit is een voorbeeldproduct 2.',
        ]);

        Filter::create([
            'name' => 'Work',
        ]);

        Filter::create([
            'name' => 'Gaming',
        ]);

        Order::create([
            'user_id' => 1,
        ]);

        Order::create([
            'user_id' => 1,
        ]);

        Amount::create([
            'order_id' => 1,
            'product_id' => 1,
            'amount' => 2,
        ]);

        Amount::create([
            'order_id' => 2,
            'product_id' => 2,
            'amount' => 3,
        ]);

        \DB::table('filter_product')->insert([
            'filter_id' => 1,
            'product_id' => 1,
        ]);
        
    }
}
