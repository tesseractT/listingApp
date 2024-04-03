<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'admin',
            ],
            [
                'name' => 'Frest Tomas',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'user',
            ]
        ]);

        //assign super admin role to super admin user

        // $user = User::where('email', 'superadmin@gmail.com')->first();
        // $user->assignRole('Super Admin');
    }
}
