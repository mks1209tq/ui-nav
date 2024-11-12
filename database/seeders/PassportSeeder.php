<?php

namespace Database\Seeders;

use App\Models\Passport;
use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Passport::factory()->count(5)->create();
    }
}
