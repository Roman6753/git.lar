<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::create([
            'full_name' => 'Admin Admin',
            'login' => 'admin',
            'phone' => '+7(836)-373-26-34',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('bookworm'),
        ]);

        User::factory(5)->create();
        Card::factory(30)->create();
    }
}
