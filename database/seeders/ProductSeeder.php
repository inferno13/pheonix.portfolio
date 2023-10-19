<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::findOrFail(1);

        // standard
        Product::create([
            'category_id' => $category->id,
            'name' => 'standard',
            'description' => 'description',
            'price' => 290,
            'license' => 1,
            'version' => '1.12',
            'download_link' => 'https://google.com',
            'currency' => true,
            'crypto' => false,
            'index' => false,
            'period' => 6,
            'tutorial' => true,
            'tech_support' => true,
            'marketing' => 1,
            'bonus' => false,
            'pull' => false
        ]);

        // business
        Product::create([
            'category_id' => $category->id,
            'name' => 'business',
            'description' => 'description',
            'price' => 390,
            'download_link' => 'https://google.com',
            'version' => '1.12',
            'license' => 1,
            'currency' => true,
            'crypto' => true,
            'index' => false,
            'period' => 6,
            'tutorial' => true,
            'tech_support' => true,
            'marketing' => 5,
            'bonus' => false,
            'pull' => true
        ]);

        // professional
        Product::create([
            'category_id' => $category->id,
            'name' => 'professional',
            'description' => 'description',
            'download_link' => 'https://google.com',
            'version' => '1.12',
            'price' => 490,
            'license' => 1,
            'currency' => true,
            'crypto' => true,
            'index' => true,
            'period' => 12,
            'tutorial' => true,
            'tech_support' => true,
            'marketing' => 10,
            'bonus' => true,
            'pull' => true
        ]);
    }
}
