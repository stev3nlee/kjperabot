<?php
namespace App\Helper;
use App\User;

class Midtrans
{

    public function redirect ($order) {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('constants.MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;  

        //$payment_account = ['gopay','bca_va','shopeepay'];

        $user = User::find($order->user_id);
        $items = [];

        foreach($order->order_details as $order_detail){
            $price = $order_detail->price - ($order_detail->price * $order_detail->sale / 100);
            array_push($items, [
                "id" => $order_detail->product_detail->product->product_code,
                "price" => $price,
                "quantity" => $order_detail->quantity,
                "name" => $order_detail->product_detail->product->product_name
            ]);
        }

        if($order->free_shipping > $order->jne_shipping_value and $order->free_shipping>0){
          $shipping = 0;
        }else{
          $shipping = $order->jne_shipping_value - $order->free_shipping;
        }

        if($shipping > 0){
          array_push($items, [
                "id" => 'shipping',
                "price" => $shipping,
                "quantity" => 1,
                "name" => 'Shipping Fee'
            ]);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_no,
                'gross_amount' => $order->total_price,
            ),
            'item_details' => $items,
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'billing_address' => array(
                  'first_name' => $order->billing_first_name,
                  'last_name' => $order->billing_last_name,
                  'email' => $order->billing_email,
                  'phone' => $order->billing_phone,
                  'address' =>  $order->billing_address,
                  'city' =>  $order->billing_jne_city_label,
                  'postal_code' =>  $order->billing_post_code,
                ),
                'shipping_address' => array(
                  'first_name' => $order->shipping_first_name,
                  'last_name' => $order->shipping_last_name,
                  'email' => $order->shipping_email,
                  'phone' => $order->shipping_phone,
                  'address' =>  $order->shipping_address,
                  'city' =>  $order->shipping_jne_city_label,
                  'postal_code' => $order->shipping_post_code,
                )
            ),
            //'enabled_payments' => $payment_account,
            // 'gopay' => array(
            //   'enable_callback' => true,
            //   'callback_url' => "https://kjperabot.co.id/checkout-success"
            // ),
            // 'shopeepay' => array(
            //   'callback_url' => "https://kjperabot.co.id/checkout-success"
            // )
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        try {
          // Get Snap Payment Page URL
          $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
          // Redirect to Snap Payment Page
          return $paymentUrl;
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
    }

}
