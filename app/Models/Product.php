<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Relatie met de categorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
