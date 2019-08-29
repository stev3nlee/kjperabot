<?php

namespace App\Mail\Administrator;
use App\Models\Contact_topic;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contact_us extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $topic = Contact_topic::where('id',$this->data['topic_id'])->first();
      $data = array_add($this->data,"topic_name",$topic->topic);
        return $this->view('email/admincontact')->subject("You have new contact")->with([
          "data"=>$data
        ]);
    }
}
