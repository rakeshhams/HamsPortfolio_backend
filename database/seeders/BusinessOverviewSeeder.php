<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BusinessOverviewSeeder extends Seeder {
    public function run() {
        DB::table('business_overviews')->insert([
            [
                'section' => 'hero',
                'title' => 'Welcome to Our Business',
                'content' => 'HAMS Garments Limited is a leading manufacturer in the textile industry, providing top-quality apparel to global markets.',
                'image' => 'business_images/hero.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section' => 'hero',
                'title' => 'Welcome to Our Business',
                'content' => 'HAMS Garments Limited is a leading manufacturer in the textile industry, providing top-quality apparel to global markets.',
                'image' => 'business_images/hero.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section' => 'hero',
                'title' => 'Welcome to Our Business',
                'content' => 'HAMS Garments Limited is a leading manufacturer in the textile industry, providing top-quality apparel to global markets.',
                'image' => 'business_images/hero.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section' => 'hero',
                'title' => 'Welcome to Our Business',
                'content' => 'HAMS Garments Limited is a leading manufacturer in the textile industry, providing top-quality apparel to global markets.',
                'image' => 'business_images/hero.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}


