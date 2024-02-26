<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('days')->insert(
            [
                'day' => 'Monday',
                'day_indonesian' => 'Senin',
                'created_at' => now(),
                'updated_at' => now()

            ]

        );
    }
}
