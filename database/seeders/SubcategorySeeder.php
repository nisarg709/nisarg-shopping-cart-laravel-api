<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subcategory::truncate();

        $users = [
            [
                'sub_category_name' => 'Mobile',
                'category_id' => 1,
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'sub_category_name' => 'Laptop',
                'category_id' => 1,
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'sub_category_name' => 'Furniture',
                'category_id' => 2,
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'sub_category_name' => 'Kitchen Storage',
                'category_id' => 2,
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'sub_category_name' => 'Jeans',
                'category_id' => 3,
                'status' => 'active',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ];
        \App\Models\Subcategory::insert($users);
    }
}
