<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title', 'description', 'discount_percent', 'start_date', 'end_date', 'image_url', 'is_active'
    ];
}
