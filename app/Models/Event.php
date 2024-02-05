<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        "event_name",
        "date",
        "available_tickets",
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
