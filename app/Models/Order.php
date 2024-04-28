<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'bestellingen';

    protected $fillable = ['DatumTijd'] ;

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'OrderID');
    }
}
