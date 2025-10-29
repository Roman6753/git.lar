<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::query()->create([
            'fio' => 'Admin Admin',
            'login' => 'Администратор',
            'tel' => '+78363732634',
            'email' => 'admin@admin.ru',
            'password' => '1111',
        ]);

        User::factory(5)->create();
    }
}
