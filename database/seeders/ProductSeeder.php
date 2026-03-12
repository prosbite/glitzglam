<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $tags = Tag::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                // Formatting the item_code (e.g., GW-01, GW-02)
                $itemCode = $category->prefix.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);

                $product = Product::create([
                    'category_id' => $category->id,
                    'item_code' => $itemCode,
                    'custom_rental_fee' => rand(1500, 5000), // Standard PH rental range
                    'custom_security_deposit' => 1000,
                    'status' => 'available', // Start all as available for testing
                    'description' => "Beautiful {$category->name} for special occasions.",
                ]);

                // Randomly attach 2-3 tags (Color, Size, Material)
                $randomTags = $tags->random(rand(2, 3))->pluck('id');
                $product->tags()->attach($randomTags);
                $product->images()->create([
                    'file_path' => 'placeholders/gown_sample.jpg',
                    'is_primary' => true,
                    'label' => 'Main View',
                ]);
            }
        }
    }
}
