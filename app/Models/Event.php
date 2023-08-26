<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'services',
        'marquee_id',
    ];
    public function marquee()
    {
        return $this->belongsTo(Marquee::class);
    }
}
