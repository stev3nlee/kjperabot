<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
  protected $fillable = [
    "product_id"
    ,"color"
    ,"stock"
  ];

  public function product()
  {
    return $this->belongsTo('App\Models\Product');
  }
}
