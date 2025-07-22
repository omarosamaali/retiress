<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'name' => 'Developer',
            'name_ar' => 'مبرمج',
            'name_en' => 'Developer',
            'email' => 'dev@dev.com',
            'role' => 'مدير'
        ]);

        $this->call(AboutUsSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(CommitteeSeeder::class);
        $this->call(CouncilSeeder::class);
        $this->call(MagazineSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
