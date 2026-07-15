<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 1. ავტომატურად ქმნის ახალ კატეგორიას და იღებს მის ID-ს
            'category_id' => Category::factory(), 
            
            // 2. აგენერირებს 3-სიტყვიან სახელს (მაგ: "Wireless Bluetooth Headphones")
            'name' => $this->faker->sentence(3), 
            
            // 3. ქმნის შემთხვევით გრძელ ტექსტს აღწერისთვის
            'description' => $this->faker->paragraph(), 
            
            // 4. აგენერირებს ფასს 10-დან 2000-მდე (მაგ: 150.50)
            'price' => $this->faker->randomFloat(2, 10, 2000), 
            
            // 5. მარაგში არსებული რაოდენობა 0-დან 100-მდე
            'stock' => $this->faker->numberBetween(0, 100), 
            
            // 6. სატესტო ფოტოს ლინკი (მაგალითად, ტექნიკის თემატიკის)
            'image_url' => $this->faker->imageUrl(640, 480, 'tech', true), 
        ];
    }
}