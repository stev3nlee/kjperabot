<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_history;
use App\Models\Product_detail;
use App\Mail\User\Expire_order_mail;


class SendExpireOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     private $orders;
    public function __construct($orders)
    {
        /* $Order  = [
          ['order_no' =>'email' ],
          ['order_no' =>'email' ],
        ]*/
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


      foreach($this->orders as $order_no => $email){
        \DB::beginTransaction();
        try {
          $order = Order::where('order_no',$order_no)->with(['billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district'])->first();
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
          \DB::commit();
          Mail::to($email)->send(new Expire_order_mail($order,$details->toArray()));
        } catch (\Exception $e) {
          \DB::rollback();
          dd($e);
        }
      }

    }
}
