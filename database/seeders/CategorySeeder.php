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
                'is_income' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Bonuses',
            ],
            [
                'is_income' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'overtime',
            ],
            [
                'is_income' => true
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Food',
            ],
            [
                'is_income' => false
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Drinks',
            ],
            [
                'is_income' => false
            ]);

        Category::firstOrCreate(
            [
                'name' => 'Shopping',
            ],
            [
                'is_income' => true
            ]);
    }
}
