<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Bank;
Use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Company_profile;
use App\Models\District;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_payment_detail;
use App\Models\Order_history;
use App\Models\Page;
use App\Models\Product_detail;
use App\Helper\Midtrans;
use App\User;
use Auth;
use Session;
use App\Jobs\SendUserOrder;
use App\Jobs\SendAdministratorNotifOrder;
class CheckoutController extends Controller
{
    public function __construct()
    {
      $this->bank = new Bank;
      $this->country = new Country;
      $this->province = new Province;
      $this->city = new City;
      $this->company_profile = new Company_profile;
      $this->district = new District;
      $this->cart = new Cart;
      $this->order = new Order;
      $this->order_detail = new Order_detail;
      $this->order_history = new Order_history;
      $this->page = new Page;
      $this->product_detail = new Product_detail;
      $this->user = new User;
      $this->midtrans = new Midtrans();
    }

    public function preCheckout()
    {

      $old_cart = $this->cart->where('user_id',Auth::user()->id)->first();
      if(count($old_cart) > 0){
        $old_cart->delete();
      }
      $cart = $this->cart->where('session_id',Session::get('profile_id'))->first();
      if(count($cart)>0){
        $cart->user_id = Auth::user()->id;
        $cart->save();
        return redirect('/checkout/shipping');
      }else{
        return redirect('/cart');
      }
    }

    public function checkoutShipping(Request $request)
    {
      if ($request->isMethod('post'))
      {
        foreach($request->input('id.*') as $key => $val){
          $cart = Cart::find($val);
          $cart->qty = $request->input('qty.'.$key);
          $cart->save();
        }
      }

      if($this->checkStock(Auth::user()->id) == false){
        return redirect('cart');
      }

      return view('checkout/shipping')->with([
        "user"    =>$this->user->where('id',Auth::user()->id)->first()
        ,"carts"  =>$this->cart->getProduct()->byUserId(Auth::user()->id)->get()
        ,"countries"  => $this->country->orderby('country_name','asc')->get()
        ,"provinces"  => $this->province->orderby('province_name','asc')->get()
      ]);
    }



    public function getDistrictShipping(Request $request)
    {
      // $post = [
      //   'username' => 'KJPERABOT',
      //   'api_key' => '2c503fe1e149001e62090e7e63144cf6',
      // ];
      $post = 'username=KJPERABOT&api_key=2c503fe1e149001e62090e7e63144cf6';

      try {
          $ch = curl_init();

          if (FALSE === $ch)
              throw new Exception('failed to initialize');

          //curl_setopt($ch, CURLOPT_URL, 'http://api.jne.co.id:8889/tracing/kjperabot/dest/key/'.$request->input('query'));
          curl_setopt($ch, CURLOPT_URL, 'http://apiv2.jne.co.id:10101/tracing/api/dest/key/'.$request->input('query'));
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
          curl_setopt($ch, CURLOPT_TIMEOUT, 120); //timeout in seconds

          $response = curl_exec($ch);

          if (FALSE === $response)
              throw new \Exception(curl_error($ch), curl_errno($ch));

          // ...process $content now
      } catch(\Exception $e) {
          trigger_error(sprintf(
              'Curl failed with error #%d: %s',
              $e->getCode(), $e->getMessage()),
              E_USER_ERROR);

      }

      // close the connection, release resources used
      curl_close($ch);
      return $response;
      //return $response;
    }

    public function getDistrictBilling($id)
    {
      return view('district_billing')->with([
        "districts"  => $this->district->where("city_id",$id)->get()
      ]);
    }

    public function checkoutPayment(Request $request)
    {
      $message =[
        "nama_depan.required" => "Kolom nama depan pengiriman wajib diisi.",
        "nama_depan.max"      => "Kolom nama depan pengiriman maksimal 50 karakter.",
        "nama_belakang.required"  => "Kolom nama belakang pengiriman wajib diisi.",
        "nama_belakang.max"       => "Kolom nama depan pengiriman maksimal 50 karakter.",
        "email.required"  => "Kolom email pengiriman wajib diisi.",
        "email.email"     => "Salah format email pengiriman.",
        "email.max"       => "Kolom email pengiriman maksimal 255 karakter.",
        "nomor_telepon.required"  => "Kolom nomor telepon pengiriman wajib diisi.",
        "nomor_telepon.max"       => "Kolom nomor telepon pengiriman maksimal 50 karakter.",
        "provinsi.required"  => "Kolom provinsi pengiriman wajib diisi.",
        "kota_shipping.required"      => "Kolom kota pengiriman wajib diisi.",
        "alamat.required"    => "Kolom alamat pengiriman wajib diisi.",
        //"kode_pos.required"  => "Kolom kode pos pengiriman wajib diisi.",

        "nama_depan_billing.required_if"  => "Kolom nama depan billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        "nama_depan_billing.max"          => "Kolom nama depan billing maksimal 50 karakter.",
        "nama_belakang_billing.required_if" => "Kolom nama belakang billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        "nama_belakang_billing.max"         => "Kolom nama depan billing maksimal 50 karakter.",
        "email_billing.required_if"   => "Kolom email billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        "email_billing.email"         => "Salah format email billing.",
        "email_billing.max"           => "Kolom email billing maksimal 255 karakter.",
        "nomor_telepon_billing.required_if"  => "Kolom nomor telepon billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        "nomor_telepon_billing.max"     => "Kolom nomor telepon billing maksimal 50 karakter.",
        "provinsi_billing.requiredif"   => "Kolom provinsi billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        "kota_billing.required_if"      => "Kolom kota wajib billing diisi apabila kolom sama alamat tidak dicentang.",
        "alamat_billing.required_if"       => "Kolom alamat billing wajib diisi apabila kolom sama alamat tidak dicentang.",
        //"kode_pos_billing.required_if"     => "Kolom kode pos billing wajib diisi apabila kolom sama alamat tidak dicentang.",


        "shipping.required"     => "Kolom pilihan metode pengiriman wajib diisi.",
      ];

      $this->validate($request,[
        "nama_depan" => "required|max:50",
        "nama_belakang" => "required|max:50",
        "email"         => "required|email|max:255",
        "nomor_telepon" => "required|max:50",
        "provinsi"      => "required",
        "kota_shipping"  => "required",
        //"kode_pos"     => "required",
        "alamat"       => "required",

        "nama_depan_billing"    => "required_if:same_address,1|max:50",
        "nama_belakang_billing" => "required_if:same_address,1|max:50",
        "email_billing"         => "required_if:same_address,1|email|max:255",
        "nomor_telepon_billing" => "required_if:same_address,1|max:50",
        "provinsi_billing"      => "required_if:same_address,1",
        "kota_billing"          => "required_if:same_address,1",
        //"kode_pos_billing"      =>"required_if:same_address,1",
        "alamat_billing"     =>"required_if:same_address,1",

        "shipping"           =>"required",

      ],$message);

      $same_address = $request->input('same_address');

      $province = $this->province->where("id",$request->input('provinsi'))->first();

      $province_billing = $this->province->where("id",$request->input('provinsi_billing'))->first();
      $dataOrder=[
        "shipping_first_name" =>$request->input('nama_depan'),
        "shipping_last_name"  =>$request->input('nama_belakang'),
        "shipping_email"      =>$request->input('email'),
        "shipping_phone"      =>$request->input('nomor_telepon'),
        "shipping_province"   =>["id"=>$province->id,"province_name"=>$province->province_name],
        "shipping_jne_city_id"   =>$request->input('jne_shipping_code'),
        "shipping_jne_city_label"=>$request->input('kota_shipping'),
        "shipping_post_code"  =>$request->input('kode_pos'),
        "shipping_address"    =>$request->input('alamat'),
        "shipping_type"       =>$request->input('shipping'),/*jne reguler or oke*/
        "shipping_cost"       =>$request->input('shipping_price_'.$request->get('shipping')),
        "free_shipping"       =>$this->company_profile::first()->free_shipping,
        "shipping_note"       =>$request->input('catatan'),

        "billing_first_name" =>($same_address==1 ? $request->input('nama_depan_billing') : $request->input('nama_depan')),
        "billing_last_name"  =>($same_address==1 ? $request->input('nama_belakang_billing') : $request->input('nama_belakang')),
        "billing_email"      =>($same_address==1 ? $request->input('email_billing') : $request->input('email')),
        "billing_phone"      =>($same_address==1 ? $request->input('nomor_telepon_billing') : $request->input('nomor_telepon')),
        "billing_province"   =>($same_address==1 ? ["id"=>$province_billing->id,"province_name"=>$province_billing->province_name] : ["id"=>$province->id,"province_name"=>$province->province_name]),
        "billing_jne_city_id"   =>($same_address==1 ? $request->input('jne_billing_code') : $request->input('jne_shipping_code')),
        "billing_jne_city_label"=>($same_address==1 ? $request->input('kota_billing') : $request->input('kota_shipping')),
        "billing_post_code"  =>($same_address==1 ? $request->input('kode_pos_billing') : $request->input('kode_pos')),
        "billing_address"    =>($same_address==1 ? $request->input('alamat_billing') : $request->input('alamat')),
        "total_weight"    =>$request->input('weight'),
      ];



      if($this->checkStock(Auth::user()->id) == false){
        return redirect('cart');
      }

      return view('checkout/payment')->with([
        "carts"   =>$this->cart->getProduct()->byUserId(Auth::user()->id)->get()
        ,"user"   =>$this->user->where('id',Auth::user()->id)->first()
        ,"bank"   =>$this->bank->first()
        ,"page"   =>$this->page->where('id',4)->first()
        ,"dataOrder"=>$dataOrder
      ]);
    }

    public function getJnePrice(Request $request)
    {
      if($request->input('code') != "0"){
        $carts = $this->cart->getProduct()->byUserId(Auth::user()->id)->get();
        $total_weight=0;
        foreach($carts as $cart){
          $total_weight += $cart->weight * $cart->qty;
        }
        // $post = [
        //   'username' =>'KJPERABOT',
        //   'api_key' => '2c503fe1e149001e62090e7e63144cf6',
        //   'from'    => 'CGK10000',
        //   'thru'    => $request->input('code'),
        //   'weight'  => $total_weight,
        // ];
        // $post = [
        //   'username' =>'TESTAPI',
        //   'api_key' => '25c898a9faea1a100859ecd9ef674548',
        //   'from'    => 'CGK10000',
        //   'thru'    => $request->input('code'),
        //   'weight'  => $total_weight,
        // ];
        $post = 'username=KJPERABOT&api_key=2c503fe1e149001e62090e7e63144cf6&from=CGK10000&thru='.$request->input('code').'&weight='.$total_weight;
        //dd($post);
        //$con = curl_init('http://api.jne.co.id:8889/tracing/kjperabot/price/');
        $con = curl_init('http://apiv2.jne.co.id:10101/tracing/api/pricedev');
        curl_setopt($con, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_POSTFIELDS, $post);
        curl_setopt($con, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($con, CURLOPT_TIMEOUT, 120); //timeout in seconds

        // execute!
        $response = curl_exec($con);
        //dd($response);
        // close the connection, release resources used
        curl_close($con);
        return view('checkout/shipping-method')->with([
          "jne"=>json_decode($response)->price,
          "total_weight"=>$total_weight
        ]);
      }else{
        return "Maaf, kami tidak dapat menemukan tujuan pengiriman anda.";
      }
    }

    public function checkoutReview(Request $request)
    {
      $data = json_decode($request->input('data_order'));

      $dataOrder=[
        "shipping_first_name" =>$data->shipping_first_name,
        "shipping_last_name"  =>$data->shipping_last_name,
        "shipping_email"      =>$data->shipping_email,
        "shipping_phone"      =>$data->shipping_phone,
        "shipping_province"   =>["id"=>$data->shipping_province->id,"province_name"=>$data->shipping_province->province_name],
        "shipping_jne_city_id"   =>$data->shipping_jne_city_id,
        "shipping_jne_city_label"=>$data->shipping_jne_city_label,
        "shipping_post_code"  =>$data->shipping_post_code,
        "shipping_address"    =>$data->shipping_address,
        "shipping_type"       =>$data->shipping_type,/*jne reguler or oke*/
        "shipping_cost"       =>$data->shipping_cost,
        "free_shipping"       =>$data->free_shipping,
        "shipping_note"       =>$data->shipping_note,

        "billing_first_name" =>$data->billing_first_name,
        "billing_last_name"  =>$data->billing_last_name,
        "billing_email"      =>$data->billing_email,
        "billing_phone"      =>$data->billing_phone,
        "billing_province"   =>["id"=>$data->billing_province->id,"province_name"=>$data->billing_province->province_name],
        "billing_jne_city_id"   =>$data->billing_jne_city_id,
        "billing_jne_city_label"=>$data->billing_jne_city_label,
        "billing_post_code"  =>$data->billing_post_code,
        "billing_address"    =>$data->billing_address,
        "total_weight"    =>$data->total_weight,
      ];

      return view('checkout/review')->with([
        "dataOrder"=>$dataOrder
        ,"bank"   =>$this->bank->first()
        ,"page"   =>$this->page->where('id',4)->first()
        ,"carts"   =>$this->cart->getProduct()->byUserId(Auth::user()->id)->get()
      ]);
    }

    public function checkoutCreate(Request $request)
    {
      if($this->checkStock(Auth::user()->id) == true){

        $order_no = $this->generateOrderNumber();

        $dataOrder = $this->setOrderVariable(json_decode($request->input('data_order')));

        $carts = $this->cart->getProduct()->byUserId(Auth::user()->id)->get();
        $order = $this->createOrder(Auth::user()->id,$order_no,$dataOrder,$carts);
        if($order != false){
          /*If not on local host, send mail*/
          if($_SERVER['REMOTE_ADDR'] != "::1"){
            //SendUserOrder::dispatch($order_no);
            //SendAdministratorNotifOrder::dispatch($order_no);
          }
          $midtrans = $this->midtrans->redirect($order);
          //header('Location: ' . $midtrans);
          return redirect($midtrans);
        }else{
          return redirect('/');
        }
      }else{
        return redirect('cart');
      }
    }

    public function testOrderMail($order_no)
    {
        return new \App\Mail\User\Order_mail($order_no);
    }

    public function testAdminOrderNotifMail($order_no)
    {
        return new \App\Mail\Administrator\Order;
    }

    public function tesExpireOrderMail($order_no)
    {
        return new \App\Mail\User\Expire_order_mail($order_no);
    }

    public function testReminderOrderMail($order_no)
    {
        return new \App\Mail\User\Reminder_order_mail($order_no);
    }

    public function midtransFinish(Request $request){
        return redirect('checkout/success/'.$request->input('order_id'));
    }

    public function midtransFailed(Request $request){
        return redirect('checkout/failed/'.$request->input('order_id'));
    }

    public function checkoutSuccess($order_no)
    {
      $order = $this->order->where('order_no',$order_no)->with(['billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district'])->first();
      if($order->user_id == Auth::user()->id){
        return view('checkout/success')->with([
          "order" => $order
          ,"details" => $this->order_detail->getProductByOrderId($order->id)->get()
        ]);
      }else{
        return redirect('/');
      }
    }

    public function checkoutFailed($order_no)
    {
      $order = $this->order->where('order_no',$order_no)->with(['billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district'])->first();
      if($order->user_id == Auth::user()->id){
        return view('checkout/failed')->with([
          "order" => $order
          ,"details" => $this->order_detail->getProductByOrderId($order->id)->get()
        ]);
      }else{
        return redirect('/');
      }
    }

    private function generateOrderNumber()
    {
      $order = $this->order->whereRaw('LEFT(order_no,4) = "'.date("Y").'"')->whereRaw('MID(order_no,5,2) = "'.date("m").'"')->max('order_no');
      if($order == 0){
        return date("Ym")."001";
      }else{
        return $order+1;
      }
    }

    private function checkStock($user_id)
    {
      $carts=$this->cart->getProduct()->byUserId($user_id)->get();
      foreach($carts as $cart){
        if($cart->total_stock < $cart->qty or $cart->total_stock == 0){
          Parent::h_flash("Stok untuk ".$cart->product_name." Warna:".$cart->color." telah habis, mohon untuk menghapus dari cart untuk memproses barang yag lain.","danger");
          return false;
          break;
        }
      }
      return true;
    }

    private function setOrderVariable($data)
    {
      $dataOrder=[
        "shipping_first_name" =>$data->shipping_first_name,
        "shipping_last_name"  =>$data->shipping_last_name,
        "shipping_email"      =>$data->shipping_email,
        "shipping_phone"      =>$data->shipping_phone,
        "shipping_province"   =>["id"=>$data->shipping_province->id,"province_name"=>$data->shipping_province->province_name],
        "shipping_jne_city_id"    =>$data->shipping_jne_city_id,
        "shipping_jne_city_label" =>$data->shipping_jne_city_label,
        "shipping_post_code"  =>$data->shipping_post_code,
        "shipping_address"    =>$data->shipping_address,
        "shipping_type"       =>$data->shipping_type,/*jne reguler or oke*/
        "shipping_cost"       =>$data->shipping_cost,
        "free_shipping"       =>$data->free_shipping,
        "shipping_note"       =>$data->shipping_note,

        "billing_first_name" =>$data->billing_first_name,
        "billing_last_name"  =>$data->billing_last_name,
        "billing_email"      =>$data->billing_email,
        "billing_phone"      =>$data->billing_phone,
        "billing_province"   =>["id"=>$data->billing_province->id,"province_name"=>$data->billing_province->province_name],
        "billing_jne_city_id"    =>$data->billing_jne_city_id,
        "billing_jne_city_label" =>$data->billing_jne_city_label,
        "billing_post_code"  =>$data->billing_post_code,
        "billing_address"    =>$data->billing_address,
        "total_weight"    =>$data->total_weight,
      ];
      return $dataOrder;
    }


    private function createOrderOld($user_id,$order_no,$data,$carts)
    {

      \DB::beginTransaction();
      try {
        $order=$this->order->create([
          "user_id"=>$user_id,
          "order_no"=>$order_no,
          "billing_first_name" =>$data['billing_first_name'],
          "billing_last_name"  =>$data['billing_last_name'],
          "billing_email"      =>$data['billing_email'],
          "billing_phone"      =>$data['billing_phone'],
          "billing_province_id"   =>$data['billing_province']['id'],
          "billing_jne_city_id"    =>$data['billing_jne_city_id'],
          "billing_jne_city_label" =>$data['billing_jne_city_label'],
          "billing_post_code"  =>$data['billing_post_code'],
          "billing_address"    =>$data['billing_address'],
          "order_note"         =>$data['shipping_note'],

          "shipping_first_name" =>$data['shipping_first_name'],
          "shipping_last_name"  =>$data['shipping_last_name'],
          "shipping_email"      =>$data['shipping_email'],
          "shipping_phone"      =>$data['shipping_phone'],
          "shipping_province_id"   =>$data['shipping_province']['id'],
          "shipping_jne_city_id"    =>$data['shipping_jne_city_id'],
          "shipping_jne_city_label" =>$data['shipping_jne_city_label'],
          "shipping_post_code"  =>$data['shipping_post_code'],
          "shipping_address"    =>$data['shipping_address'],
          "jne_shipping_method" =>$data['shipping_type'],
          "jne_shipping_value"  =>$data['shipping_cost'],
          "free_shipping"       =>$data['free_shipping'],
          "order_status"        =>1,
          "tax_vat"             =>$this->company_profile->first()->tax_vat,
          "total_weight"        =>$data['total_weight'],
        ]);


        foreach($carts as $cart){
          $items[] =[
            "order_id"=>$order->id
            ,"product_detail_id"=>$cart->product_detail_id
            ,"quantity"=>$cart->qty
            ,"sale"=>$cart->sale
            ,"price"=>$cart->product_price
          ];
          $this->product_detail->where("id",$cart->product_detail_id)->decrement('stock',$cart->qty);
        }
        $this->order_detail->insert($items);
        $this->order_history->create([
          "order_id" => $order->id,
          "action"   => "Pending"
        ]);
        $this->cart->where('user_id',$user_id)->delete();
        \DB::commit();
        return true;
      } catch (\Exception $e) {

        \DB::rollback();
        return false;
      }
    }

    public function midtransNotif(Request $request){
        try {
            \Midtrans\Config::$serverKey = config('constants.MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = true;
            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;
            $message = '';

            $order = Order::where('order_no',$order_id)->first();
            $check_status = Order_payment_detail::where('status',$transaction)->where('order_id',$order->id)->first(); 
            $payment_detail = new Order_payment_detail;
            $payment_detail->order_id = $order->id; 


            if($order && !$check_status){
                if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                    if ($type == 'credit_card') {
                        if ($fraud == 'challenge') {
                            // TODO set payment status in merchant's database to 'Challenge by FDS'
                            // TODO merchant should decide whether this transaction is authorized or not in MAP
                            $message = "Transaction order_id: " . $order_id ." is challenged by FDS";
                            $order_status = 1;
                        } else {
                            // TODO set payment status in merchant's database to 'Success'
                            $message =  "Transaction order_id: " . $order_id ." successfully captured using " . $type;
                            $order_status = 3;
                        }
                    }
                } else if ($transaction == 'settlement') {
                    // TODO set payment status in merchant's database to 'Settlement'
                    $message =  "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
                    $order_status = 3;
                } else if ($transaction == 'pending') {
                    // TODO set payment status in merchant's database to 'Pending'
                    $message =  "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
                    $order_status = 1;
                } else if ($transaction == 'deny') {
                    // TODO set payment status in merchant's database to 'Denied'
                    $message =  "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
                    $order_status = 4;
                } else if ($transaction == 'expire') {
                    // TODO set payment status in merchant's database to 'expire'
                    $message =  "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
                    $order_status = 4;
                } else if ($transaction == 'cancel') {
                    // TODO set payment status in merchant's database to 'Denied'
                    $message =  "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
                    $order_status = 4;
                }


                if($transaction == 'settlement'){
                    $transaction = 'success';
                }

                if($transaction == 'expire' && $order->return_stock == 0){
                  $details = Order_detail::getProductByOrderId($order->id)->get();

                  foreach($details as $detail){
                    $product_detail = Product_detail::where('id',$detail->product_detail_id)->first();
                    if($product_detail){
                      $product_detail->stock = $product_detail->stock + $detail->quantity;
                      $product_detail->save();
                    }
                  }
                  $order->return_stock = 1;
                }

                $payment_detail->status = $transaction;
                $payment_detail->signature = $notif->signature_key;
                $payment_detail->tansaction_id = $notif->transaction_id;
                $payment_detail->payload = json_encode($request->all());
                $payment_detail->message = $message;
                $payment_detail->save();

                $order->payment_method = $type;
                $order->order_status = $order_status;

                if($type == 'bank_transfer'){
                  if(isset($notif->permata_va_number)){
                    $order->va_number = $notif->permata_va_number;
                  }
                  if(isset($notif->va_numbers[0]->va_number)){
                    $order->va_number = $notif->va_numbers[0]->va_number;
                  }
                }
                else if($type == 'qris'){
                  $order->acquirer = $notif->acquirer;
                }
                $order->save();

                $this->order_history->create([
                  "order_id" => $order->id,
                  "action"   => ucwords($transaction)
                ]);

                SendUserOrder::dispatch($order->order_no);
                if($transaction == 'settlement'){
                    SendAdministratorNotifOrder::dispatch($order->order_no);
                }
                //SendAdministratorNotifOrder::dispatch($order->order_no);
            }

            echo "sukses";
        } catch (\Exception $e) {
            echo "failed";
        }

//         {
//   "status_code": "200",
//   "status_message": "midtrans payment notification",
//   "transaction_id": "1c28dbbb-8596-48e4-85d7-9f1382db8a1f",
//   "order_id": "order03",
//   "gross_amount": "275000.00",
//   "payment_type": "gopay",
//   "transaction_time": "2016-06-19 15:54:42",
//   "transaction_status": "settlement",
//   "signature_key": "973d175e6368ad844b5817882489e6b22934d796a41a0573c066b1e64532dc0001087b87d877a3eac37cba20a733e1305f5e62739e65ff501d5d33c5ac62530f"
// }

// {
//   "va_numbers": [
//     {
//       "va_number": "812785002530231",
//       "bank": "bca"
//     }
//   ],
//   "transaction_time": "2019-10-23 16:33:49",
//   "transaction_status": "pending",
//   "transaction_id": "be03df7d-2f97-4c8c-a53c-8959f1b67295",
//   "status_message": "midtrans payment notification",
//   "status_code": "201",
//   "signature_key": "b07e6b0c6e7786363f9d7c1502e1171143fefe38e1a2bb93bce87e0fb64dd2ddfbbc8c7d60c6dcd7d6d8edb22169fd46e2250a6a547aa9f3f6da206a63334360",
//   "payment_type": "bank_transfer",
//   "payment_amounts": [

//   ],
//   "order_id": "1571823229",
//   "merchant_id": "G812785002",
//   "gross_amount": "44000.00",
//   "fraud_status": "accept",
//   "currency": "IDR"
// }
        
    }

    private function createOrder($user_id,$order_no,$data,$carts)
    {

      \DB::beginTransaction();
      try {
        $order=$this->order->create([
          "user_id"=>$user_id,
          "order_no"=>$order_no,
          "billing_first_name" =>$data['billing_first_name'],
          "billing_last_name"  =>$data['billing_last_name'],
          "billing_email"      =>$data['billing_email'],
          "billing_phone"      =>$data['billing_phone'],
          "billing_province_id"   =>$data['billing_province']['id'],
          "billing_jne_city_id"    =>$data['billing_jne_city_id'],
          "billing_jne_city_label" =>$data['billing_jne_city_label'],
          "billing_post_code"  =>$data['billing_post_code'],
          "billing_address"    =>$data['billing_address'],
          "order_note"         =>$data['shipping_note'],

          "shipping_first_name" =>$data['shipping_first_name'],
          "shipping_last_name"  =>$data['shipping_last_name'],
          "shipping_email"      =>$data['shipping_email'],
          "shipping_phone"      =>$data['shipping_phone'],
          "shipping_province_id"   =>$data['shipping_province']['id'],
          "shipping_jne_city_id"    =>$data['shipping_jne_city_id'],
          "shipping_jne_city_label" =>$data['shipping_jne_city_label'],
          "shipping_post_code"  =>$data['shipping_post_code'],
          "shipping_address"    =>$data['shipping_address'],
          "jne_shipping_method" =>$data['shipping_type'],
          "jne_shipping_value"  =>$data['shipping_cost'],
          "free_shipping"       =>$data['free_shipping'],
          "order_status"        =>1,
          "tax_vat"             =>$this->company_profile->first()->tax_vat,
          "total_weight"        =>$data['total_weight'],
        ]);

        $price = 0;
        $subtotal=0;
        foreach($carts as $cart){
          $items[] =[
            "order_id"=>$order->id
            ,"product_detail_id"=>$cart->product_detail_id
            ,"quantity"=>$cart->qty
            ,"sale"=>$cart->sale
            ,"price"=>$cart->product_price
            ,"discount_amount"=>$cart->discount_amount
          ];
          $this->product_detail->where("id",$cart->product_detail_id)->decrement('stock',$cart->qty);

          $price = $cart->product_price - $cart->discount_amount;
          $subtotal += $price *$cart->qty;
        }
        $tax = ($order->tax_vat * $subtotal /100);
        if($order->free_shipping > $order->jne_shipping_value and $order->free_shipping>0){
          $grandtotal = $subtotal + $tax + 0;
        }else{
          $grandtotal = $subtotal + $tax + $order->jne_shipping_value - $order->free_shipping;
        }

        $this->order_detail->insert($items);
        $this->order_history->create([
          "order_id" => $order->id,
          "action"   => "Pending"
        ]);
        $this->cart->where('user_id',$user_id)->delete();

        $update_order = Order::find($order->id);
        $update_order->total_price = $grandtotal;
        $update_order->save();

        \DB::commit();
        return $update_order;
      } catch (\Exception $e) {

        \DB::rollback();
        return false;
      }
    }
}
