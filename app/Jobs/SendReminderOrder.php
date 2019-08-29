<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\User\Reminder_order_mail;


class SendReminderOrder implements ShouldQueue
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
      try {
        foreach($this->orders as $order_no => $email){
          Mail::to($email)->send(new Reminder_order_mail($order_no));
        }
        return "Success";
      } catch (\Exception $e) {
        return "Failed";
        dd($e);
      }


    }
}
