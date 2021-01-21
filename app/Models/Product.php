<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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
      ,"sale_price"
      ,"discount_amount"
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
      $query->select("products.slug","products.product_name","products.product_price","products.image_path","products.sale","products.sale_price","products.discount_amount", \DB::raw('SUM(quantity) as total_sales'));
      $query->leftjoin("product_details","product_details.product_id","products.id");
      $query->leftjoin("order_details","order_details.product_detail_id","product_details.id");
      $query->groupby("products.id","products.slug","products.product_name","products.product_price","products.image_path","products.sale","products.sale_price","products.discount_amount");
      $query->withCount([
                          'product_details AS total_stock' => function ($query) {
                                      $query->select(DB::raw("SUM(stock) as total_stock"));
                                  }
                              ]);
      $query->having('total_stock', '>', 0);
      $query->orderby("total_sales","desc");
      $query->limit(16);
      return $query;
    }

    public function scopeGetBySaleProduct($query)
    {
      $query->select("products.slug","products.product_name","products.product_price","products.image_path","products.sale","products.updated_at","products.sale_price","products.discount_amount");
      $query->where("sale_price","!=",0);
      $query->orderby("updated_at","desc");
      $query->limit(16);
      return $query;
    }


    public function scopeGetProduct($query)
    {
      $query->leftjoin("subcategories","subcategories.id","products.subcategory_id");
      return $query;
    }

    public function scopeGetOrder($query,$order)
    {
      //CASE WHEN sale_price IS NOT NULL THEN sale_price ELSE product_price END AS total_price
      $query->select('*',\DB::raw('product_price - discount_amount AS total_price'));
      
      $query->withCount([
                          'product_details AS totalstock' => function ($query) {
                                      $query->select(DB::raw("SUM(stock) as totalstock"));
                                  }
                              ]);
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
