<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_history;
use App\Models\Product_detail;

class Expire_order_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     private $order_no;
    public function __construct($order_no)
    {
      $this->order_no = $order_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = Order::where('order_no',$this->order_no)->with(['billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district'])->first();
        $details = Order_detail::getProductByOrderId($order->id)->get();

        $tempOrder=Order::find($order->id);
        $tempOrder->order_status = 4;
        $tempOrder->save();

        foreach($details as $detail){
          $product_detail = Product_detail::where('id',$detail->product_detail_id)->first();
          $product_detail->stock = $product_detail->stock + $detail->quantity;
          $product_detail->save();
        }

        Order_history::create([
          "order_id"=>$order->id,"action"=>"Expire"
        ]);

      return $this->view('email/expire_order')->subject("Order #".$this->order_no ." Sudah Tidak Berlaku.")->with([
        "order"=>$order,
        "details"=>$details
      ]);
    }
}
