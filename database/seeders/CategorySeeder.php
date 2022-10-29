<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(
            [
                'name' => 'Salary',
            ],
            [
                'is_income' => true,
                'default' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Bonuses',
                'default' => true
            ],
            [
                'is_income' => true,
                'default' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'overtime',
            ],
            [
                'is_income' => true,
                'default' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Food',
            ],
            [
                'is_income' => false,
                'default' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Drinks',
            ],
            [
                'is_income' => false,
                'default' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Shopping',
            ],
            [
                'is_income' => true,
                'default' => true
            ]);
    }
}
