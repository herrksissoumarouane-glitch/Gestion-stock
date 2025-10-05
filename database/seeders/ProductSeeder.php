<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Electronics'];
        $categoryIds = [];
        $imageUrls = [
            'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&w=600',
            'https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/279906/pexels-photo-279906.jpeg?auto=compress&cs=tinysrgb&w=600',
            'https://images.pexels.com/photos/8066712/pexels-photo-8066712.png?auto=compress&cs=tinysrgb&w=600',
            'https://images.pexels.com/photos/3602258/pexels-photo-3602258.jpeg?auto=compress&cs=tinysrgb&w=600',
        ];

        foreach ($categories as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
            ]);
            $categoryIds[] = $category->id;
        }

        for ($i = 0; $i < 30; $i++) {
            Product::create([
                'name' => fake()->words(2, true),
                'image' => fake()->randomElement($imageUrls),
                'description' => fake()->paragraph(),
                'price' => fake()->randomFloat(2, 10, 500),
                'quantity' => fake()->numberBetween(1, 100),
                'category_id' => fake()->randomElement($categoryIds),
            ]);
        }
    }
}
