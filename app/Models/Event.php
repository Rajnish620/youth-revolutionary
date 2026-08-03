<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'location',
        'category',
        'image',
        'description',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function groups()
    {
        return $this->hasMany(EventGroup::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
