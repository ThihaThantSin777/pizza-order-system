<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[

        'order_id',
        'customer_id',
        'carrier_id',
        'pizza_id',
        'pay_status',
        'order_time',
    ];
}
