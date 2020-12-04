<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      "user_id"
      ,"order_no"
      ,"billing_first_name"
      ,"billing_last_name"
      ,"billing_email"
      ,"billing_phone"
      ,"billing_province_id"
      ,"billing_jne_city_id"
      ,"billing_jne_city_label"
      ,"billing_post_code"
      ,"billing_address"
      ,"order_note"
      ,"shipping_first_name"
      ,"shipping_last_name"
      ,"shipping_email"
      ,"shipping_phone"
      ,'shipping_province_id'
      ,"shipping_jne_city_id"
      ,"shipping_jne_city_label"
      ,"shipping_post_code"
      ,"shipping_address"
      ,"jne_shipping_method"
      ,"order_status"
      ,"jne_shipping_value"
      ,"jne_track"
      ,"tax_vat"
      ,"free_shipping"
      ,"total_weight"
      ,"is_remindered"
      ,"is_remindered_23"
      ,'is_deleted'
      ,'payment_method'
      ,'total_price'
      ,'va_number'
    ];

    public function scopeByUser($query,$user_id)
    {
      $query->select('orders.*',\DB::raw('sum(((price - (price * sale / 100))*quantity)) AS total'));
      $query->join('order_details','order_details.order_id','orders.id');
      $query->where('user_id',$user_id);
      $query->groupBy("orders.id","user_id"
      ,"order_no","billing_first_name","billing_last_name","billing_email"
      ,"billing_phone","billing_province_id",'billing_jne_city_id',"billing_jne_city_label","billing_post_code","billing_address"
      ,"order_note","shipping_province_id","total_weight"
      ,"shipping_first_name","shipping_last_name"
      ,"shipping_email","shipping_phone"
      ,'shipping_jne_city_id',"shipping_jne_city_label"
      ,"shipping_post_code","shipping_address","jne_shipping_method",'free_shipping'
      ,"order_status","jne_shipping_value","jne_track"
      ,"tax_vat","orders.created_at","orders.updated_at","price","Sale","quantity","is_deleted","is_remindered","is_remindered_23");
      return $query;
    }

    public function scopeByOrder($query,$order_id)
    {
      return $query->where('orders.id',$order_id);
    }

    public function order_details()
    {
      return $this->hasMany('App\Models\Order_detail');
    }

    public function product()
    {
      $this->belongsTo('App\Models\Product');
    }

    public function shipping_province()
    {
      return $this->hasOne('App\Models\Province','id','shipping_province_id');
    }
    public function shipping_city()
    {
      return $this->hasOne('App\Models\City','id','shipping_city_id');
    }
    public function shipping_district()
    {
      return $this->hasOne('App\Models\District','id','shipping_district_id');
    }

    public function billing_province()
    {
      return $this->hasOne('App\Models\Province','id','billing_province_id');
    }
    public function billing_city()
    {
      return $this->hasOne('App\Models\City','id','billing_city_id');
    }
    public function billing_district()
    {
      return $this->hasOne('App\Models\District','id','billing_district_id');
    }

    public function order_histories()
    {
      return $this->hasMany('App\Models\Order_history');
    }

    public function payments()
    {
      return $this->hasMany('App\Models\Confirm_payment');
    }

    public function scopeByOrderId($query,$user_id,$order_no)
    {
      $query->join('order_details','order_details.order_id','orders.id');
      $query->where('orders.user_id',$user_id)->where('orders.order_no',$order_no);
      return $query;
    }

    public function scopeGetReminderOrder($query)
  	{
      $query->where('order_status',1)->where('is_deleted',0)->where('is_remindered',0)->whereRaw('TIMESTAMPDIFF(hour,created_at,NOW()) = 42');
      return $query;
  	}

    public function scopeGetReminderOrder23($query)
  	{
      $query->where('order_status',1)->where('is_deleted',0)->where('is_remindered_23',0)->whereRaw('TIMESTAMPDIFF(hour,created_at,NOW()) = 47');
      return $query;
  	}

  	public function scopeGetExpireOrder($query)
  	{
      $query->where('order_status',1)->where('is_deleted',0)->where('is_remindered',1)->whereRaw('TIMESTAMPDIFF(hour,created_at,NOW()) = 48');
      return $query;
  	}

    public function scopeGetRecordForReport($query,$start_date,$end_date)
    {
      $query->select('B.id','orders.order_no','orders.created_at','product_name','B.price'
                      ,\DB::raw('(B.price - (B.price * B.sale / 100)) AS net_price')
                      ,'B.quantity'
                      ,\DB::raw('(B.price * B.quantity) - ((B.price * B.quantity) * B.sale / 100) AS subtotal')
                      ,\DB::raw('((B.price  - (B.price  * B.sale / 100)) * B.quantity * orders.tax_vat / 100) AS tax')
                      ,'orders.jne_shipping_value'
                      ,\DB::raw('CASE WHEN free_shipping >= jne_shipping_value THEN jne_shipping_value ELSE free_shipping END AS free_shipping')
                      ,\DB::raw('((B.price * B.quantity) - ((B.price * B.quantity) * B.sale / 100) -
                        (CASE WHEN free_shipping >= jne_shipping_value THEN jne_shipping_value ELSE free_shipping END) + jne_shipping_value) AS total')
                      ,"orders.billing_first_name"
                      ,"orders.billing_last_name"
                      ,"orders.billing_email"
                      ,"orders.billing_jne_city_label"
                      ,\DB::raw("(CASE WHEN orders.order_status = 1 THEN 'Pending'
                          WHEN orders.order_status = 2 THEN 'Sedang diproses'
                          WHEN orders.order_status = 3 THEN 'Sukses'
                          WHEN orders.order_status = 4 THEN 'Batal'
                          WHEN orders.order_status = 5 THEN 'Refund' END) AS status" )
                      ,"jne_track");
      $query->join('order_details   AS B','B.order_id','orders.id');
      $query->join('product_details AS C','B.product_detail_id','C.id');
      $query->join('products        AS D','C.product_id','D.id');
      $query->whereBetween('orders.created_at',[$start_date,$end_date]);
      return $query;
    }
}
