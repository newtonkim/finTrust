<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ChartOfAccountsSeeder::class,
            // Add other seeders here if you have them
        ]);
    }
}
