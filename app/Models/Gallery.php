<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'season_id',
        'category',
        'image',
        'description',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
