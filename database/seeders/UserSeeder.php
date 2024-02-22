<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $users = [
            [
                'name'           => 'anas',
                'email'          => 'admin@said.com',
                'password'       => bcrypt('987654321'),
                'remember_token' => null
            ],
            [
                'name'           => 'bilal',
                'email'          => 'user@said.com',
                'password'       => bcrypt('987654321'),
                'remember_token' => null
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
