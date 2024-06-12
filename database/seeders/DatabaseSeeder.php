<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@jewelry.com',
        ]);
        
        // \App\Models\Gem::factory()->create([
        //     'name'=> 'Kim Cương Quan Điểm',
        //     'is_gem_stone'=> true,
        //     'price'=> 100,
        //     'image'=> null,
        // ]);

        // \App\Models\Order::factory()->create([
        //     'id' => 1,
        //     'order_type'=> 'buying',
        //     'order_date'=> now(),
        //     'total_price'=> 100,
        //     'user_id'=> 1,
        // ]);

        // \App\Models\OrderDetail::factory()->create([
        //     'gem_id'=> 1,
        //     'order_id'=>1
        // ]);

    }
}
