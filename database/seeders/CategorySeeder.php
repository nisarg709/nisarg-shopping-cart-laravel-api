<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::truncate();

        $users = [
            [
                'category_name' => 'Electronics',
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'category_name' => 'Home & Furniture',
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'category_name' => 'Fashion',
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ];
        \App\Models\Category::insert($users);
    }
}
