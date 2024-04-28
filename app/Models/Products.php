<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    // Tabelnaam
    protected $table = 'products';

    // Kolommen die mass assignment toestaan
    protected $fillable = [
        'product_id', 'product_name', 'category_id', 'price', 'image_url'
    ];

    // Relatie met de categorie
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

