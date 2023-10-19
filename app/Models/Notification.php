<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['detail_id', 'detail_type', 'text', 'user_id', 'unread', 'name'];

    public function details()
    {
        return $this->morphTo('detail');
    }
}
