<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product; // 👈 აუცილებლად შემოგვაქვს პროდუქტის მოდელი
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. იქმნება სატესტო მომხმარებელი, რომლითაც ფრონტენდიდან (ან Postman-იდან) შეძლებ დალოგინებას
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // 👈 პაროლი იქნება "password"
        ]);

        // 2. აი ეს მთავარი ხაზი! ავტომატურად ქმნის 50 პროდუქტს და 50 უნიკალურ კატეგორიას
        Product::factory(50)->create();
    }
}