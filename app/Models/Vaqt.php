<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaqt extends Model
{
    use HasFactory;
    protected $table = 'vaqt';
    protected $fillable = ['id', 'userid', 'kun', 'vaqt'];
}
