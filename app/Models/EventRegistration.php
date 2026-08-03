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
        'roll_no',
        'student_name',
        'father_name',
        'school_name',
        'student_class',
        'mobile',
        'fee_paid',
        'photo',
        'payment_screenshot',
        'payment_status',
        'marks',
        'rank',
        'certificate_enabled',
    ];

    protected $casts = [
        'certificate_enabled' => 'boolean',
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
