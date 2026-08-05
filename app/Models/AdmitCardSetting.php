<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmitCardSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_title',
        'header_subtitle',
        'logo_path',
        'signature_path',
        'instructions',
    ];

    public static function getSettings()
    {
        $settings = self::first();

        if (!$settings) {
            $settings = self::create([
                'instructions' => "1. This is a computer-generated admit card.\n2. Please bring a valid photo ID to the examination center.\n3. Electronic devices are strictly prohibited.",
            ]);
        }

        return $settings;
    }
}
