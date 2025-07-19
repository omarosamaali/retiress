<?php

namespace Database\Seeders;

use App\Models\Council;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouncilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Council::insert([
            [
                'name_ar' => 'عبد الله',
                'name_en' => 'Abdullah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'محمد',
                'name_en' => 'Mohammed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'عبد الوهاب',
                'name_en' => 'Abd Al Wahab',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
