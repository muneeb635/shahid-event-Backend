<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $fillable = [
        'hall',
        'date',
        'marque_revenue',
        'owner_revenue',
        'partner_revenue',
        'marquee_id',
    ];
}
