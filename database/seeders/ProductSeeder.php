<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Product::truncate();

        $products = [
            [
                'product_name' => 'Lenovo Ideapad S145 Core i5 10th Gen',
                'category' => 'Electronics',
                'sub_category' => 'Laptop',
                'price' => 8000,
                'status' => 'active',
                'description' => 'Be at your productive best with this laptop from Lenovo. Powered by the Intel Core i5 1035G1 10th generation processor and 8 GB of RAM, this laptop can handle anything you want it to do. This sleek laptop is designed to complement your style. The narrow bezels and the 39.62 cm Anti-glare Full HD Display deliver a seamless viewing experience.',
                'image' => 'lenovo.jpeg',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'product_name' => 'OnePlus One (Silk White, 16 GB)  (3 GB RAM)',
                'category' => 'Electronics',
                'sub_category' => 'Mobile',
                'price' => 20000,
                'status' => 'active',
                'description' => 'The OnePlus One is powered by a Qualcomm Snapdragon 801 processor and 3 GB RAM which allows it to handle performance-heavy applications with ease. With a 13 MP Sony Exmor IMX214 primary camera and LED flash, you will be able to capture memorable moments with sharp image quality.',
                'image' => 'one-plus.jpeg',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'product_name' => 'Homes Studio Wood Portable Laptop Table',
                'category' => 'Home & Furniture',
                'sub_category' => 'Furniture',
                'price' => 3000,
                'status' => 'active',
                'description' => '"WATCH, PLAY, STUDY WITHOUT LEAVING YOUR BED! Are you an avid lover of comfy bed? or recovering from past surgery? Want to work on comfy sofa or couch? Our SKUDGEAR Laptop Desks found the solution for your queries! These desks perfectly fit for a small size laptop, tablet and also can read, write while sitting comfortably on the sofa. Foldable Design: Space Saving Foldable Design Legs helps to keep in a corner or under bad when not in use. High-Quality Materials: Made of MDF wood and aluminum alloy tube which strong enough to use. With Cup Holder: This Table comes with a cup holder to keep your favourite drink within your reach. Simple Design: Advanced Modern Design Laptop Desk with a classic look and gives you a good mood to work. Easy to Clean: The surface is smooth and non-toxic, dirt-proof and waterproof."',
                'image' => 'plywood.jpeg',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ];
        \App\Models\Product::insert($products);
    }
}
