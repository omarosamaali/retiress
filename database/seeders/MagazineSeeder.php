<?php

namespace Database\Seeders;

use App\Models\Magazine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MagazineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Magazine::create([
            'title_ar' => 'مجلة الأطفال',
            'title_en' => 'Children Magazine',
            'description_ar' => 'هذه مجلة للأطفال',
            'description_en' => 'This is a children magazine',
            'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
            'sub_image' => [
                '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
            ]
        ]);
        Magazine::create([
            'title_ar' => 'مجلة المرأة',
            'title_en' => 'Women Magazine',
            'description_ar' => 'هذه مجلة للمرأة',
            'description_en' => 'This is a women magazine',
            'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
            'sub_image' => [
                '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
            ]
        ]);
        Magazine::create([
            'title_ar' => 'مجلة الرياضة',
            'title_en' => 'Sports Magazine',
            'description_ar' => 'هذه مجلة للرياضة',
            'description_en' => 'This is a sports magazine',
            'main_image' => '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
            'sub_image' => [
                '/about-us/main/RpDdolZurlQ0gNP4jQrkCdgArfNjDZGY9ldWF4iY.png',
                '/about-us/sub/9SkxvZ7cMtA2KhvVNRS4bEPgqR629kNFgtQ6O354.png',
            ]
        ]);
    }
}
