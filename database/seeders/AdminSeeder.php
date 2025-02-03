<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name' => 'Administrator',
            'email' => 'andra@gmail.com',
            'password' => bcrypt('12345678')
        ];

        $check = User::where('email', $payload['email'])->first();
        if (is_null($check)) {
            User::create($payload);
        }
    }
}
