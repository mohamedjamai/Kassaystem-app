<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sushirolls extends Model
{
    protected $fillable = ['category_name', 'image_url', 'category_url'];
}
