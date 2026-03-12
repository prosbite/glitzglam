<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['type' => 'color', 'name' => 'Royal Blue'],
            ['type' => 'color', 'name' => 'Crimson Red'],
            ['type' => 'color', 'name' => 'Emerald Green'],
            ['type' => 'size', 'name' => 'Small'],
            ['type' => 'size', 'name' => 'Medium'],
            ['type' => 'size', 'name' => 'Large'],
            ['type' => 'size', 'name' => 'XL'],
            ['type' => 'material', 'name' => 'Lace'],
            ['type' => 'material', 'name' => 'Satin'],
            ['type' => 'material', 'name' => 'Tulle'],
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'type' => $tag['type'],
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']), // Generates "royal-blue", "crimson-red", etc.
            ]);
        }
    }
}
