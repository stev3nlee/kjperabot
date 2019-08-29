<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_history extends Model
{
    protected $fillable = [
      "order_id","action"
    ];
}
