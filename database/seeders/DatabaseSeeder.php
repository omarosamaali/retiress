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
            'name' => 'Omar Osama',
            'name_ar' => 'عمر أسامة',
            'name_en' => 'Omar Osama',
            'email' => 'dev@dev.com',
            'password' => '123456789',
            'role' => 'مدير'
        ]);

        // $this->call(AboutUsSeeder::class);
        // $this->call(MemberSeeder::class);
        // $this->call(CommitteeSeeder::class);
        // $this->call(CouncilSeeder::class);
        // $this->call(MagazineSeeder::class);
        // $this->call(ServiceSeeder::class);
        // $this->call(SettingSeeder::class);
    }
}
