<?php

namespace Database\Seeders;

use App\Enums\ActivityStatusEnums;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{Hash, Schema};

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $users = [
            [
                'full_name' => 'User One',
                'username' => 'user_one',
                'email' => 'user@one.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'full_name' => 'User Two',
                'username' => 'user_two',
                'email' => 'user@two.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'full_name' => 'User Three',
                'username' => 'user_three',
                'email' => 'user@three.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'full_name' => 'User Four',
                'username' => 'user_four',
                'email' => 'user@four.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ]
        ];

        User::insert($users);
    }
}
