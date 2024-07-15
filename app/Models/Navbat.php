<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbat extends Model
{
    use HasFactory;
    protected $table = 'navbat';
    protected $fillable = [
        'userid',
        'sana',
        'vaqt',
        'ism',
        'tel',
        'maqsad',
        'status',
        'xizmatkorsatildi',
    ];
}
