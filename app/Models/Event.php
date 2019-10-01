<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event', 'transaction_id', 'store_name', 'product_name', 'product_price'];
}
