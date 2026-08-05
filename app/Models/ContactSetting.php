<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address',
        'whatsapp',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'map_embed_url'
    ];

    public static function getSettings()
    {
        $settings = self::first();

        if (!$settings) {
            $settings = self::create([
                'phone' => '+91 8864012433',
                'email' => 'info@youthrevolutionary.com',
                'address' => 'Patna, NASRIGANJ',
                'whatsapp' => '918864012433',
                'facebook_link' => '#',
                'instagram_link' => 'https://www.instagram.com/youthrevolutionarynasriganj',
                'youtube_link' => 'https://youtube.com/@youthrevolutionary6914',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13742.422869504217!2d84.31943645036904!3d25.052886394862792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d091675b59f13%3A0x3eef4953d224224f!2sNasriganj%2C%20Bihar%20821310!5e1!3m2!1sen!2sin!4v1782300158703!5m2!1sen!2sin'
            ]);
        }

        return $settings;
    }
}
