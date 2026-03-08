<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image_url',
        'price_uah',
        'price_it_coins',
        'cashback_percent',
        'is_active',
        'tag',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_uah' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
