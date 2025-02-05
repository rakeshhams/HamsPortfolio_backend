<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessHeroSection;

class HeroSectionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        BusinessHeroSection::create([
            'title' => 'Welcome to Our Business Overview',
            'description' => 'This is the hero section of our business overview page, showcasing the essence of our company.',
            'hero_image' => 'hero_images/default_hero.jpg', // Simulating an image path
            'additional_image' => 'hero_images/default_additional.jpg', // Simulating an image path
        ]);
    }
}

