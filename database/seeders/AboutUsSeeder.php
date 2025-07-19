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
        AboutUs::insert([
            [
                'key' => 'about_us',
                'title_en' => 'This is title in English',
                'title_ar' => 'هذا العنوان بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'admin_message',
                'title_en' => 'This is admin message in English',
                'title_ar' => 'هذا الرسالة من الإدارة بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'company_message',
                'title_en' => 'This is company message in English',
                'title_ar' => 'هذا رسالتنا بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'our_goals',
                'title_en' => 'This is Goals in English',
                'title_ar' => 'هذه أهدافنا بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'our_values',
                'title_en' => 'This is Our Values in English',
                'title_ar' => 'هذه قيمنا بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'our_vision',
                'title_en' => 'This is company message in English',
                'title_ar' => 'هذا رسالتنا بالعربية',
                'description_en' => 'This is description in English',
                'description_ar' => 'هذا الوصف بالعربية',
                'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                'sub_image' => '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
