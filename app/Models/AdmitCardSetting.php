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
        'president_name',
        'president_role',
        'secretary_name',
        'secretary_role',
    ];

    public static function getSettings()
    {
        $settings = self::first();

        if (!$settings) {
            $settings = self::create([
                'instructions' => "1. This is a computer-generated admit card.\n2. Please bring a valid photo ID to the examination center.\n3. Electronic devices are strictly prohibited.",
                'president_name' => 'NIKETAN SINGH',
                'president_role' => 'अध्यक्ष',
                'secretary_name' => 'SHYAM SUNDAR KR.',
                'secretary_role' => 'सचिव',
            ]);
        }

        return $settings;
    }
}
