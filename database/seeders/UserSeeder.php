<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::truncate();

        $users = [
            [
                'name' => 'Ana James',
                'email' => 'ana.james@example.com',
                'username' => 'ana',
                'role' => 'user',
                'status' => 'active',
                'currency' => 'USD',
                'language' => 'EN',
                'password' => Hash::make('user@123'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Dylan Austin',
                'email' => 'dylan.austin@example.com',
                'username' => 'dylan',
                'role' => 'shop',
                'status' => 'active',
                'currency' => 'USD',
                'language' => 'EN',
                'password' => Hash::make('shop@123'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ];
        \App\Models\User::insert($users);
    }
}
