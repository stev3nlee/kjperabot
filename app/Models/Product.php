<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      "slug"
      ,"product_name"
      ,"product_code"
      ,"subcategory_id"
      ,"product_price"
      ,"product_description"
      ,"image_path"
      ,"sale"
      ,"weight"
    ];

    public function subcategory()
    {
      return $this->belongsTo('App\Models\Subcategory');
    }

    public function product_details()
    {
      return $this->hasMany('App\Models\Product_detail');
    }


    public function scopeGetByHotProduct($query)
    {
      $query->select("products.slug","products.product_name","products.product_price","products.image_path","products.sale", \DB::raw('SUM(quantity) as total_sales'));
      $query->leftjoin("product_details","product_details.product_id","products.id");
      $query->leftjoin("order_details","order_details.product_detail_id","product_details.id");
      $query->groupby("products.slug","products.product_name","products.product_price","products.image_path","products.sale");
      $query->orderby("total_sales","desc");
      $query->limit(4);
      return $query;
    }

    public function scopeGetBySaleProduct($query)
    {
      $query->select("products.slug","products.product_name","products.product_price","products.image_path","products.sale","products.updated_at");
      $query->where("sale","!=",0);
      $query->orderby("updated_at","desc");
      $query->limit(4);
      return $query;
    }


    public function scopeGetProduct($query)
    {
      $query->leftjoin("subcategories","subcategories.id","products.subcategory_id");
      return $query;
    }

    public function scopeGetOrder($query,$order)
    {
      $query->select('*',\DB::raw('product_price - ( product_price * sale / 100 ) AS total_price'));
      if($order == 'terbaru'){
        $query->orderby("products.id",'desc');
      }else{
        $query->orderby("total_price",$order);
      }
      
      return $query;
    }

    public function scopeByCategory($query,$category)
    {
      $query->where("subcategories.category_id",$category);
      return $query;
    }

    public function scopeBySubcategory($query,$subcategory)
    {
      $query->where("products.subcategory_id",$subcategory);
      return $query;
    }

    public function scopeBySearch($query,$search)
    {
      $searchs = explode(" ",$search);
      foreach($searchs as $search){
        $query->where("product_name","like","%".$search."%");
      }
      return $query;
    }
}
