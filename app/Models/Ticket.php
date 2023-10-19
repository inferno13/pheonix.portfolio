<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'ticket_category_id', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket_category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
