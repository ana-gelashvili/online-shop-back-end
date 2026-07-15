<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. ვიღებთ გარანტირებულად უნიკალურ სიტყვას (მაგ: "books")
        $name = $this->faker->unique()->word();

        return [
            // 2. პირველ ასოს ვაკეთებთ დიდს (მაგ: "Books")
            'name' => ucfirst($name),
            
            // 3. ამავე სიტყვისგან ვაკეთებთ სლუგს (მაგ: "books")
            'slug' => Str::slug($name),
        ];
    }
}