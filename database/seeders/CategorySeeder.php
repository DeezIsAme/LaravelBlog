<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Design',
            'slug'=> 'web-design',
            'color' => 'red'
        ]);
        Category::create([
            'name' => 'Learning Android',
            'slug'=> 'learning-android',
            'color' => 'blue'
        ]);
        Category::create([
            'name' => 'Machine Learning',
            'slug'=> 'machine-learning',
            'color' => 'green'
        ]);
        Category::create([
            'name' => 'Internet of Things',
            'slug'=> 'internet-of-things',
            'color' => 'yellow'
        ]);
        Category::create([
            'name' => 'Data Science',
            'slug'=> 'data-science',
            'color' => 'pink'
        ]);
    }
}
