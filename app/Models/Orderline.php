<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'bestellingregels';

    public function order()
    {

        $order = new SaleOrder;

        $order->user_id = 5;

        return $this->belongsTo(Order::class, 'OrderID');
    }
}
