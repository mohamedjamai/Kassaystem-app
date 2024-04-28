<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;

    // Tabelnaam
    protected $table = 'sale_orders';

    // Kolommen die mass assignment toestaan
    protected $fillable = [
        'user_id', 'notitie', 'totaal_bedrag'
    ];

}
