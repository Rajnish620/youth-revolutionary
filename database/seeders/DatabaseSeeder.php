<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'youth@sws.com',
            'password' => Hash::make('youth@1234'),
        ]);

        // $this->call([
        //     CompetitionSeeder::class,
        //     GallerySeeder::class,
        //     EventSeeder::class,
        //     EventRegistrationSeeder::class,
        //     AboutUsSeeder::class,
        // ]);
    }
}
