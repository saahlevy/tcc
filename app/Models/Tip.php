<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'age_range',
        'category'
    ];
} 