<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'description',
        'start_date',
        'valid_until',
        'discount_percent',
    ];

    protected $casts = [
        'start_date' => 'date',
        'valid_until' => 'date',
    ];
}
