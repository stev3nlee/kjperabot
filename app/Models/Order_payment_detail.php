<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_payment_detail extends Model
{
    public $timestamps = true;
    protected $table = 'order_payment_detail';
    protected $fillable = ['order_id', 'status', 'message', 'payload', 'signature', 'tansaction_id'];
    protected $attributes = [
        'payload' => null,
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

}
