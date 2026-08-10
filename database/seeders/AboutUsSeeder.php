<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsSetting;
use App\Models\TeamMember;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUsSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'About Us',
                'hero_subtitle' => 'Empowering Young Minds Through Education, Sports & Cultural Excellence.',
                'hero_bg_image' => 'images/NIKON Z 502317.JPG.jpeg',
                'who_we_are_title' => 'Youth Revolutionary',
                'who_we_are_description' => "Youth Revolutionary (A Unit of SWS) is a student-centric social & educational movement operating in Nasriganj, Charhanpuri. Our core mission is to discover hidden talents among school & college students by providing structured talent search examinations, sports competitions, and cultural festivals.\n\nSince inception, we have helped thousands of students build academic confidence, win prestigious awards, and achieve national recognition.",
                'who_we_are_image' => 'images/WhatsApp Image 2026-06-24 at 12.37.06 PM.jpeg',
                'mission_title' => 'Our Mission',
                'mission_description' => 'To provide every student with an equal opportunity to compete, excel, and win recognition through transparent examinations and talent festivals.',
                'vision_title' => 'Our Vision',
                'vision_description' => 'To become the leading youth talent development organization across Bihar and Eastern India, inspiring educational & co-curricular excellence.',
                'stat_1_count' => '10,000+',
                'stat_1_label' => 'Students Impacted',
                'stat_2_count' => '100+',
                'stat_2_label' => 'Competitions Hosted',
                'stat_3_count' => '50+',
                'stat_3_label' => 'Partner Schools',
                'stat_4_count' => '15+',
                'stat_4_label' => 'Cities Reached',
            ]
        );

        // Seed Team Members if empty
        if (TeamMember::count() === 0) {
            TeamMember::create([
                'name' => 'Dr. Rajesh Kumar',
                'role' => 'President & Patron',
                'image' => 'images/dance2.JPG',
                'description' => 'Leading educational mentor with over 15 years of experience in student welfare and competitive talent assessment.',
                'is_featured' => true,
                'sort_order' => 1,
            ]);

            TeamMember::create([
                'name' => 'Amit Sharma',
                'role' => 'Founder & Managing Director',
                'image' => 'images/dance3.JPG',
                'description' => 'Social entrepreneur passionate about promoting sports, academics, and cultural youth empowerment in Nasriganj.',
                'is_featured' => true,
                'sort_order' => 2,
            ]);

            TeamMember::create([
                'name' => 'Priya Singh',
                'role' => 'Academic Coordinator',
                'image' => 'images/quize.jpg',
                'description' => 'Manages exam curation, roll sequence verification, and talent assessment criteria for all competition categories.',
                'is_featured' => false,
                'sort_order' => 3,
            ]);
        }
    }
}
