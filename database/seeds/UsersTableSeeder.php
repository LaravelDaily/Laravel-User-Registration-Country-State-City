<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$Z.deoxA.2IZ2bOWmxdHIrOrE2bpSITwiC2kEfASrB8lsDrBkWYvSW',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
