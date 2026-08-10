<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'polaroid_1_image',
        'polaroid_1_text',
        'polaroid_2_image',
        'polaroid_2_text',
        'polaroid_3_image',
        'polaroid_3_text',
        'middle_banner_image',
    ];

    public static function getSettings()
    {
        return self::first() ?? self::create([
            'polaroid_1_text' => '"You let learning grow."',
            'polaroid_2_text' => 'in 38 districts',
            'polaroid_3_text' => 'together we protect the youth.',
        ]);
    }
}
