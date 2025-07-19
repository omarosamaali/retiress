<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Committee::insert([
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
