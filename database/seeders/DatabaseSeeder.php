<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Inventory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '0',
            'role' => 'admin',
            'password'=> '1',
        ]);

        Category::create([
            'title' => 'Laptop',
        ]);
        Category::create([
            'title' => 'Keyboard',
        ]);
        Category::create([
            'title' => 'Mouse',
        ]);

        $categories = [1, 2, 3];

        for ($i = 1; $i <= 20; $i++) {
            $quantity = fake()->numberBetween(5, 50);

            Inventory::create([
                'title' => 'Item ' . $i,
                'code' => strtoupper(Str::random(6)),
                'category_id' => fake()->randomElement($categories),
                'quantity' => $quantity,
                'available_quantity' => fake()->numberBetween(0, $quantity),
                'location' => 'Rack ' . fake()->numberBetween(1, 10),
            ]);
        }
    }
}
