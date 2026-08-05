<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_bg_image',
        'who_we_are_title',
        'who_we_are_description',
        'who_we_are_image',
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'stat_1_count',
        'stat_1_label',
        'stat_2_count',
        'stat_2_label',
        'stat_3_count',
        'stat_3_label',
        'stat_4_count',
        'stat_4_label',
    ];

    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'About Us',
                'hero_subtitle' => 'Empowering Young Minds Through Education, Sports & Cultural Excellence.',
                'who_we_are_title' => 'Youth Revolutionary',
                'who_we_are_description' => 'Youth Revolutionary is a student-focused organization dedicated to discovering, nurturing, and recognizing young talents across academics, sports, and cultural competitions.',
                'mission_title' => 'Our Mission',
                'mission_description' => 'To provide students with a competitive platform that inspires excellence, builds confidence, and fosters holistic development.',
                'vision_title' => 'Our Vision',
                'vision_description' => 'To become a premier youth movement that transforms potential into achievements for thousands of students across the region.',
                'stat_1_count' => '10000+',
                'stat_1_label' => 'Students Impacted',
                'stat_2_count' => '100+',
                'stat_2_label' => 'Competitions Hosted',
                'stat_3_count' => '50+',
                'stat_3_label' => 'Partner Schools',
                'stat_4_count' => '15+',
                'stat_4_label' => 'Cities Reached',
            ]
        );
    }
}
