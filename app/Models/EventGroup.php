<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'group_name',
        'class_range',
        'fee',
        'max_participants',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
