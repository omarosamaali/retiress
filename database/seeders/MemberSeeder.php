<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::insert([
            [
                'name_ar' => 'عبد الله',
                'name_en' => 'Abdullah',
                'position_ar' => 'رئيس',
                'position_en' => 'President',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'محمد',
                'name_en' => 'Mohammed',
                'position_ar' => 'رئيس',
                'position_en' => 'President',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'عبد الوهاب',
                'name_en' => 'Abd Al Wahab',
                'position_ar' => 'رئيس',
                'position_en' => 'President',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
