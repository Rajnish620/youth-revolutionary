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
        'reporting_time',
        'exam_time',
        'location',
        'category',
        'season',
        'image',
        'description',
        'is_featured',
        'status',
        'show_marks',
        'show_certificate',
        'total_questions',
        'marks_per_question',
        'negative_marks',
        'total_marks',
        'cutoff_marks',
        'marking_scheme_notes',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'show_marks' => 'boolean',
        'show_certificate' => 'boolean',
        'total_questions' => 'integer',
        'marks_per_question' => 'decimal:2',
        'negative_marks' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'cutoff_marks' => 'decimal:2',
    ];

    public function getResultModeAttribute(): string
    {
        if ($this->show_marks && $this->show_certificate) {
            return 'both';
        }
        if ($this->show_marks) {
            return 'marks';
        }
        if ($this->show_certificate) {
            return 'certificate';
        }
        return 'none';
    }

    public function groups()
    {
        return $this->hasMany(EventGroup::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function answerKeys()
    {
        return $this->hasMany(AnswerKey::class);
    }
}
