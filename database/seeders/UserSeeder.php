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
        User::create([
            'name' => 'Yago Admin',
            'email'=> 'yago@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Empregado1',
            'email'=> 'empregado1@empresa.com',
            'password' => bcrypt('empregado123'),
            'role' => 'user',
        ]);
    }
}