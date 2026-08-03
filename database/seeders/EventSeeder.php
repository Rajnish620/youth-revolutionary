<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'title' => 'Talent Search Festival Nashariganj',
            'slug' => 'talent-search-festival-nashariganj',
            'event_date' => '2026-09-15',
            'location' => 'Patna Nashariganj',
            'category' => 'Education',
            'image' => 'images/NIKON Z 502317.JPG.jpeg',
            'description' => 'प्रतिभा खोज महोत्सव एक ऐसा मंच है, जहाँ बच्चों, युवाओं एवं प्रतिभाशाली व्यक्तियों को अपनी कला, ज्ञान, कौशल और रचनात्मकता प्रदर्शित करने का अवसर प्रदान किया जाता है।',
            'is_featured' => true,
            'status' => 'upcoming',
        ]);

        Event::create([
            'title' => 'National Quiz Competition 2026',
            'slug' => 'national-quiz-competition-2026',
            'event_date' => '2026-09-20',
            'location' => 'Patna Nashariganj',
            'category' => 'Education',
            'image' => 'images/quize.jpg',
            'description' => 'Science and General Knowledge quiz championship for school students.',
            'is_featured' => false,
            'status' => 'upcoming',
        ]);

        Event::create([
            'title' => 'Inter School Run Racing Tournament',
            'slug' => 'inter-school-run-racing-tournament',
            'event_date' => '2026-10-05',
            'location' => 'Sports Complex, Patna',
            'category' => 'Sports',
            'image' => 'images/FB_IMG_1780913014941.jpg.jpeg',
            'description' => 'Annual 100m, 400m and relay track running tournament for youth.',
            'is_featured' => false,
            'status' => 'upcoming',
        ]);

        Event::create([
            'title' => 'Youth Dance & Music Championship',
            'slug' => 'youth-dance-music-championship',
            'event_date' => '2026-10-15',
            'location' => 'Cultural Auditorium, Patna',
            'category' => 'Cultural',
            'image' => 'images/danses.jpeg',
            'description' => 'Solo and group dance and singing talent search event.',
            'is_featured' => false,
            'status' => 'upcoming',
        ]);
    }
}
