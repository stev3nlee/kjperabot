<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $fillable = [
    "user_id","product_detail_id","qty","session_id"
  ];

  public function scopeGetProduct($query)
  {
    $query->select('carts.id AS cart_id','carts.qty',"product_details.color",'products.*',\DB::raw('SUM(stock) AS total_stock'),'product_details.id AS product_detail_id');
    $query->join('product_details','product_details.id','carts.product_detail_id');
    $query->join('products','products.id','product_details.product_id');
    $query->groupby('cart_id','carts.qty',"product_details.color",'products.id','products.slug','products.product_name','products.product_code','products.subcategory_id','products.sale','products.weight','products.product_price','products.product_description','products.image_path','products.created_at','products.updated_at','product_details.id');
    return $query;
  }

  public function scopeByUserId($query,$user_id)
  {
    $query->where('user_id',$user_id);
    return $query;
  }

  public function scopeBySessionId($query,$session_id)
  {
    $query->where('session_id',$session_id);
    return $query;
  }
}
