<?php

namespace App\Mail\Administrator;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     private $campaign_name;
     private $campaign_image;
     private $template;
     private $products;
     private $hide_product;
    public function __construct($data)
    {
      $this->campaign_name = $data['campaign_name'];
      $this->campaign_image = $data['campaign_image'];
      $this->template = $data['template'];
      $this->products = $data['products'];
      $this->hide_product = $data['hide_product'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('email/newsletter')->subject($this->campaign_name)->with([
        "data"=>[
          "campaign_name"   =>$this->campaign_name,
          "campaign_image"  =>$this->campaign_image,
          "template"        =>$this->template,
          "products"        =>$this->products,
          "hide_product"    =>$this->hide_product,
        ]
      ]);
    }
}
