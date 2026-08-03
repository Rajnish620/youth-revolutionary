<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'upi_id',
        'account_holder',
        'qr_code_image',
        'instructions',
        'auto_enable_certificates',
    ];

    protected $casts = [
        'auto_enable_certificates' => 'boolean',
    ];

    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'upi_id' => 'sws@upi',
                'account_holder' => 'Youth Revolutionary Organization',
                'qr_code_image' => 'images/sample_qr.png',
                'instructions' => 'Scan QR Code using any UPI App (GPay, PhonePe, Paytm), pay the exact registration fee, and upload the payment screenshot.',
                'auto_enable_certificates' => false,
            ]
        );
    }
}
