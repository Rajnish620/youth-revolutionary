<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        Competition::create([
            'title' => 'National Science & Tech Quiz 2026',
            'slug' => 'national-science-tech-quiz-2026',
            'category' => 'education',
            'description' => 'Test your knowledge in Science, Mathematics, and Coding among thousands of students nationwide.',
            'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=800',
            'start_date' => '2026-08-15',
            'end_date' => '2026-08-20',
            'registration_fee' => 100.00,
            'status' => 'active',
        ]);

        Competition::create([
            'title' => 'State Level Youth Sports Meet',
            'slug' => 'state-level-youth-sports-meet',
            'category' => 'sports',
            'description' => 'Annual sports tournament featuring Football, Athletics, Cricket, and Badminton matches.',
            'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=800',
            'start_date' => '2026-09-01',
            'end_date' => '2026-09-05',
            'registration_fee' => 200.00,
            'status' => 'upcoming',
        ]);

        Competition::create([
            'title' => 'Inter-College Cultural & Dance Fest',
            'slug' => 'inter-college-cultural-dance-fest',
            'category' => 'cultural',
            'description' => 'Showcase your artistic talent in Singing, Classical & Folk Dance, Drama, and Painting.',
            'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80&w=800',
            'start_date' => '2026-08-25',
            'end_date' => '2026-08-27',
            'registration_fee' => 150.00,
            'status' => 'active',
        ]);
    }
}
