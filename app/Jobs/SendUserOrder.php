<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Order;
use App\Models\Order_detail;
use App\Mail\User\Order_mail;
use Mail;
class SendUserOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $order_no;

    public function __construct($order_no)
    {
        $this->order_no = $order_no;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $order = Order::where('order_no',$this->order_no)->first();
      Mail::to($order->billing_email)->send(new Order_mail($this->order_no));
    }
}
