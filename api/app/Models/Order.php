<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_nr',
        'paid',
        'first_name',
        'last_name',
        'pfadiname',
        'email',
        'delivery_first_name',
        'delivery_last_name',
        'delivery_street',
        'delivery_zip',
        'delivery_town',
        'amount',
        'quantity',
        'shipping_date',
    ];
}
