<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'user_id'];

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
