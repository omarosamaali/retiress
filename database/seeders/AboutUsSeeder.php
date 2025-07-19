<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AboutUs::create([
            'title_en' => 'This is title in English',
            'title_ar' => 'هذا العنوان بالعربية',
            'description_en' => 'This is description in English',
            'description_ar' => 'هذا الوصف بالعربية',
            'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
            'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
            'status' => true
        ]);
    }
}
