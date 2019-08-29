<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_history;

class Reminder_order_mail extends Mailable
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
      $tempOrder->is_remindered = 1;
      $tempOrder->save();

      Order_history::create([
        "order_id"=>$order->id,"action"=>"Remindered 46"
      ]);

      return $this->view('email/reminder_order')->subject("Reminder Order #".$this->order_no)->with([
        "order"=>$order,
        "details"=>$details
      ]);
    }
}
