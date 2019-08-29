<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Order;
use App\Jobs\SendExpireOrder;
use Mail;
use App\Mail\User\Expire_order_mail;
class ExpireOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpireOrder:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire an order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $orders = Order::getExpireOrder()->pluck('billing_email','order_no');
      if(count($orders)>0){
        foreach($orders as $order_no => $email){
            Mail::to($email)->send(new Expire_order_mail($order_no));
        }
      }
    }
}
