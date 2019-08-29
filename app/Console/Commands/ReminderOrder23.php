<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Order;
use App\Jobs\SendReminderOrder23;
use Mail;
use App\Mail\User\Reminder_order_mail23;
class ReminderOrder23 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ReminderOrder23:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder order when due 23 hours is reached';

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
        $orders = Order::getReminderOrder23()->pluck('billing_email','order_no');
        if(count($orders) > 0){
          foreach($orders as $order_no => $email){
            Mail::to($email)->send(new Reminder_order_mail23($order_no));
          }
          //SendReminderOrder23::dispatch($orders);
        }
    }
}
