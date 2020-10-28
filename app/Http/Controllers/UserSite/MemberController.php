<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Confirm_payment;
Use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_history;
use App\Models\Wishlist;
use App\Models\Subscriber;
use App\User;
use Newsletter;
use Auth;
use Mail;
class MemberController extends Controller
{
    public function __construct()
    {
      $this->confirm_payment = new Confirm_payment;
      $this->country = new Country;
      $this->province = new Province;
      $this->city = new City;
      $this->district = new District;
      $this->order = new Order;
      $this->order_detail = new Order_detail;
      $this->order_history = new Order_history;
      $this->user = new User;
      $this->wishlist = new Wishlist;
    }

    public function showProfile(Request $request)
    {		/*
      if(Auth::user()->is_verified == 0){
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Parent::h_flash('Mohon verifikasi email anda terlebih dahulu.','danger');
        return redirect('/sign');
      }	  */
      $user = Auth::user();
      return view('member/profile')->with([
        "user" => $user
        ,"countries" => $this->country->orderby('country_name','asc')->get()
        ,"provinces" => $this->province->orderby('province_name','asc')->get()
        ,"cities" => $this->city->orderby('city_name','asc')->get()
        ,"districts"=>($user->city_id == null ? array() : $this->district->where("city_id",$user->city_id)->orderby('district_name','asc')->get() )
      ]);
    }

    public function getDistrict ($id)
    {
      return view('district')->with([
        "districts"=>$this->district->where('city_id',$id)->get()
      ]);
    }

    public function saveProfile(Request $request)
    {
      $message = [
        "nama_depan.required" => "Kolom nama depan wajib diisi.",
        "nama_depan.max"      => "Kolom nama depan maksimal 50 karakter.",

        "nama_belakang.required"  => "Kolom nama belakang wajib diisi.",
        "nama_belakang.max"       => "Kolom nama depan maksimal 50 karakter.",

        "email.required"  => "Kolom email wajib diisi.",
        "email.email"     => "Mohon isi email dengan benar",
        "email.max"       => "Kolom email maksimal 255 karakter.",
        "email.unique"    => "Email tersebut telah terdaftar.",

        "nomor_telepon.required"  => "Kolom nomor telepon wajib diisi.",
        "nomor_telepon.max"       => "Kolom nomor telepon maksimal 50 karakter.",

        "negara.required"       => "Kolom negara wajib diisi.",
        "provinsi.required_if"  => "Kolom provinsi wajib diisi apabila negara yang dipilih adalah indonesia.",
        "kota.required_if"      => "Kolom kota wajib diisi apabila negara yang dipilih adalah indonesia.",
        "kecamatan.required_if" => "Kolom kecamatan wajib diisi apabila negara yang dipilih adalah indonesia.",
        "alamat.required"       => "Kolom alamat wajib diisi.",
        "kode_pos.required"       => "Kolom kode pos wajib diisi.",
      ];
      $this->validate($request,[
        "nama_depan"    => "required|max:50",
        "nama_belakang" => "required|max:50",
        "nomor_telepon" => "required|max:50",
        "negara"        => "required",
        "provinsi"      => "required_if:negara,101",
        "kota"          => "required_if:negara,101",
        "kecamatan"     => "required_if:negara,101",
        "alamat"        => "required",
        "kode_pos"     => "required",
      ],$message);

      try {
        $user = $this->user->where('id',Auth::user()->id)->first();
        $user->first_name = $request->input('nama_depan');
        $user->last_name = $request->input('nama_belakang');
        $user->phone = $request->input('nomor_telepon');
        $user->country_id = $request->input('negara');
        $user->province_id = $request->input('provinsi');
        $user->city_id = $request->input('kota');
        $user->district_id = $request->input('kecamatan');
        $user->address = $request->input('alamat');
        $user->post_code = $request->input('kode_pos');
        $user->save();
        Parent::h_flash('Data tersebut telah berhasil diganti.','success');
      } catch (\Exception $e) {
        Parent::h_flash('Data tersebut error, mohon menghubungi ke KJ Perabot.','danger');
      }
      return redirect()->back();
    }

    public function changePassword(Request $request)
    {
      $message = [
        "password_lama.required"  => "Kolom password lama wajib diisi.",
        "password_baru.required"  => "Kolom password baru wajib diisi.",
        "password_baru.min"       => "Kolom password baru minimal 6 karakter.",
        "password_baru.confirmed" => "Kolom password dan konfirmasi password tidak sesuai.",
      ];

      $this->validate($request,[
        "password_lama" => "required",
        "password_baru" => "required|min:6|confirmed"
      ],$message);

      try {
        if(\Hash::check($request->input('password_lama'),Auth::user()->password))
        {
    			if(!\Hash::check($request->input('password_baru'),Auth::user()->password))
    			{
    				$user=$this->user->where('id',Auth::user()->id)->first();
    			  $user->password = bcrypt($request->input('password_baru'));
    			  $user->updated_at = date("Y-m-d H:i:s");
    			  $user->save();
    			  Parent::h_flash("Password tersebut telah berhasil diubah.","success");
    			}else{
    				Parent::h_flash("Password baru tidak boleh sama dengan password lama.","danger");
    			}
        }else{
          Parent::h_flash("Password lama tidak sama dengan password saat ini.","danger");
        }
      } catch (\Exception $e) {
        Parent::h_flash('Data tersebut error, mohon menghubungi ke KJ Perabot.','danger');
      }
      return redirect()->back();
    }

    public function showNewsletter()
    {
      return view('member/newsletter')->with([
        "subscriber"=>Subscriber::where('email',Auth::user()->email)->first()
      ]);
    }

    public function saveNewsletter(Request $request)
    {
      $user = $this->user->where('id',Auth::user()->id)->first();
      $subscriber = Subscriber::where('email',$user->email)->first();
      if(empty($subscriber)){
        Subscriber::create([
          "email" => $user->email, "is_subscribe" => 1
        ]);
        Newsletter::subscribeOrUpdate($user->email, ['firstName'=>$user->first_name, 'lastName'=>$user->last_name]);
      }else{
        if($request->input('is_subscribe') == 1){
          $subscriber->is_subscribe =1;
          $subscriber->save();
          Newsletter::subscribeOrUpdate($user->email, ['firstName'=>$user->first_name, 'lastName'=>$user->last_name]);
        }else{
          $subscriber->is_subscribe =0;
          $subscriber->save();
          Newsletter::unsubscribe($user->email);
        }
      }

      Parent::h_flash("Anda telah berhasil merubah data.","success");
      return redirect()->back();
    }

    public function showWishlist(Request $request)
    {
      return view('member/wishlist')->with([
        "wishlists" => $this->wishlist->getProduct(Auth::user()->id)->get()
      ]);
    }

    public function deleteWishlist(Request $request)
    {
      $this->wishlist->where('id',$request->input('id'))->delete();
      Parent::h_flash("Produk ini telah dihapus dalam daftar wishlist.","success");
      return redirect()->back();
    }

    public function showOrderHistory(Request $request)
    {
      return view('member/order')->with([
        "orders"=>$this->order->with('order_details')->where('user_id',Auth::user()->id)->orderby('id','desc')->get()
      ]);
    }

    public function showOrderHistoryDetail(Request $request,$order_no)
    {
      $check = $this->order->where('order_no',$order_no)->first();
      
      if(!empty($check)){
        $order = $this->order->where('order_no',$order_no)->with(['billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district'])->first();

        return view('member/order-detail')->with([
          "order"=>$this->order->byUser(Auth::user()->id)->byOrder($order->id)->get()
          ,"order2"=>$order
          ,"details" => $this->order_detail->getProductByOrderId($order->id)->get()
        ]);
      }else{
        abort('404');
      }
    }

    public function showConfirmPayment()
    {
      return view('member/confirm-payment');
    }

    public function saveConfirmPayment(Request $request)
    {
      $message = [
        "order_no.required" => "Kolom nomor order wajib diisi.",
        "order_no.max" => "Kolom nomor order maksimal 15 karakter.",
        "account_no.required" => "Kolom nomor akun bank wajib diisi.",
        "account_name.required" => "Kolom nama akun bank wajib diisi.",
        "nominal.required" => "Kolom biaya yang sudah ditransfer wajib diisi.",
        "image.required" => "Kolom bukti pembayaran wajib dipilih.",
      ];

      $this->validate($request,[
        "order_no" => "required|max:15"
        ,"account_no"=>"required"
        ,"account_name"=>"required"
        ,"nominal"=>"required"
        ,"image"=>"required|mimes:jpg,jpeg,pdf,png"
      ],$message);

      $order = $this->order->where('order_no',$request->input('order_no'))->where('user_id',Auth::user()->id)->first();
      if(count($order) > 0){
        $image = $request->file('image');
        $filename = strtotime("now").".".$image->getClientOriginalExtension();
        $image->move('images/bukti',$filename);
        $imageTemp="images/bukti/".$filename;
        \DB::beginTransaction();
        try {

          $this->confirm_payment->create([
            "order_id"=>$order->id,
            "bank_account_no"=>$request->input('account_no'),
            "bank_account_name"=>$request->input('account_name'),
            "nominal"=>$request->input('nominal'),
            "image_path"=>$imageTemp
          ]);

          if($order->order_status == 1){
            $this->order->where('id',$order->id)->update([
              "order_status" => 2
            ]);
          }

          $this->order_history->create([
            "order_id" => $order->id,
            "action"   => "Submit payment"
          ]);
          \DB::commit();
          Parent::h_flash('Anda telah berhasil melakukan input. Mohon menunggu kabar dari KJ Perabot.','success');
        } catch (\Exception $e) {
          \DB::rollback();
          Parent::h_flash('Data tersebut error, mohon menghubungi ke KJ Perabot.','danger');
        }
      }else{
        Parent::h_flash('Nomor Order Anda Salah.','warning');
      }
      return redirect()->back();
    }
    
    public function testmail()
    { 
      Mail::raw('Test Email', function ($message) {
        $message->to('anthony@idsskincare.com')
          ->subject('test email');
      });
      dd(Mail::failures());
        //     Mail::send('test',null , function($message)
        // {
        //     $message->from(
        //         'noreply@kjperabot.co.id',
        //         'KJP'
        //     );
        //     $message->to('steven@idsskincare.com');
        //     $message->subject('test email');
        // });    
        
      
    }
}
