<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
  protected $fillable = [
    "order_id","product_detail_id","quantity","sale","price","discount_amount"
  ];

  public function product_detail()
  {
    return $this->belongsTo('App\Models\Product_detail');
  }

  public function product()
  {
    return $this->belongsTo('App\Models\Product');
  }

  public function scopeGetProductByOrderId($query,$order_id)
  {
    $query->select('products.image_path','product_details.color','products.weight','products.product_name','order_details.*');
    $query->join('product_details','product_details.id','order_details.product_detail_id');
    $query->join('products','products.id','product_details.product_id');
    $query->where('order_id',$order_id);
    return $query;
  }
}
