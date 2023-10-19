<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'license', 'currency', 'crypto', 'version', 'download_link',
        'index', 'period', 'tutorial', 'tech_support', 'marketing', 'bonus', 'pull', 'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
