<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::create([
            'title' => 'Quiz Competition Final',
            'category' => 'Session 1',
            'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=800',
            'description' => 'Students participating in science quiz competition.',
        ]);

        Gallery::create([
            'title' => 'Cricket Tournament Winners',
            'category' => 'Session 1',
            'image' => 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&q=80&w=800',
            'description' => 'Annual sports award distribution ceremony.',
        ]);

        Gallery::create([
            'title' => 'Folk Dance Performance',
            'category' => 'Session 2',
            'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80&w=800',
            'description' => 'Cultural event dance performance.',
        ]);

        Gallery::create([
            'title' => 'Debate Championship',
            'category' => 'Session 2',
            'image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&q=80&w=800',
            'description' => 'Youth debate championship 2026.',
        ]);
    }
}
