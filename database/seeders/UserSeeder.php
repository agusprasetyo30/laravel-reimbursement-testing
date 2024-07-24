<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Direktur
        User::create([
            "nip" => 1234,
            "name" => "DONI",
            "email" => "doni@gmail.com",
            "role" => "direktur",
            "password" => Hash::make("12345")
        ]);

        // finance
        User::create([
            "nip" => 1235,
            "name" => "DONO",
            "email" => "dono@gmail.com",
            "role" => "finance",
            "password" => Hash::make("12345")
        ]);

        // staff
        User::create([
            "nip" => 1236,
            "name" => "DONA",
            "email" => "dona@gmail.com",
            "role" => "staff",
            "password" => Hash::make("12345")
        ]);
    }
}
