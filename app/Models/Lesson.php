<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['video_id', 'next', 'number', 'education_id', 'is_unlocked'];

    public function video() {
        return $this->belongsTo(Video::class);
    }
}
