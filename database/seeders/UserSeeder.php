<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kredit.com',
            'password' => Hash::make('123'), 
            'role' => 'admin',
        ]);

        // Marketing
        User::create([
            'name' => 'Marketing',
            'email' => 'marketing@kredit.com',
            'password' => Hash::make('1234'),
            'role' => 'marketing',
        ]);

        // CEO
        User::create([
            'name' => 'CEO',
            'email' => 'ceo@kredit.com',
            'password' => Hash::make('12345'),
            'role' => 'ceo',
        ]);
    }
}
