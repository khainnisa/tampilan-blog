<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryList = Category::all();
        $categoryList->each(function ($category) {
            $category->blogs()->saveMany(
                Blog::factory(5)->make(
                    ['category_id' => $category->id]
                )
            );
        });
    }
}
