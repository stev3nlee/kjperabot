<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
  protected $fillable = [
    "user_id"
    ,"product_id"
  ];

  public function scopeGetProduct($query,$user_id)
  {
    $query->select('wishlists.id AS wishlist_id','products.*',\DB::raw('SUM(stock) AS total_stock'));
    $query->join('products','products.id','wishlists.product_id');
    $query->join('product_details','product_details.product_id','products.id');
    $query->where('wishlists.user_id',$user_id);
    $query->groupby('wishlist_id','products.id','products.slug','products.product_name','products.product_code','products.subcategory_id','products.sale','products.product_price','products.product_description','products.image_path','products.weight','products.created_at','products.updated_at');
    return $query;
  }
}
