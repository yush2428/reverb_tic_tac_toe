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
                'name' => 'User One',
                'email' => 'user@one.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'name' => 'User Two',
                'email' => 'user@two.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'name' => 'User Three',
                'email' => 'user@three.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ],
            [
                'name' => 'User Four',
                'email' => 'user@four.com',
                'password' => Hash::make('Password@1234'),
                'status' => ActivityStatusEnums::OFFLINE,
            ]
        ];

        User::insert($users);
    }
}
