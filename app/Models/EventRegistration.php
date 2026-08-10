<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'event_group_id',
        'registration_no',
        'roll_no',
        'student_name',
        'father_name',
        'school_name',
        'student_class',
        'mobile',
        'fee_paid',
        'photo',
        'payment_screenshot',
        'transaction_id',
        'payment_status',
        'marks',
        'rank',
        'certificate_enabled',
        'is_admit_card_allowed',
        'dob',
        'email',
        'gender',
        'category',
        'address',
    ];

    protected $casts = [
        'certificate_enabled' => 'boolean',
        'is_admit_card_allowed' => 'boolean',
        'marks' => 'decimal:2',
        'fee_paid' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function group()
    {
        return $this->belongsTo(EventGroup::class, 'event_group_id');
    }
}
