<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountryCitySeeder::class);
        $this->call(StatusesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
