<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Crypt;
use App\Jobs\SendResetPassword;
class ForgotPasswordController extends Controller
{
    public function __construct()
    {
      $this->user = new User;
    }

    public function showForgotPassword()
    {
      return view('member/forget');
    }

    public function sendResetLink(Request $request)
    {
      $message=[
        "email.required" => "Mohon isi kolom email.",
        "email.email" => "Mohon isi email dengan benar.",
      ];
      $this->validate($request,[
        "email"=>'required|email'
      ],$message);


      $user = $this->user->where('email',$request->input('email'))->first();
      if(count($user) > 0){
        $user->is_on_reset_password = 1;
        $user->save();
        $token = Crypt::encrypt($request->input('email'));
        SendResetPassword::dispatch($request->input('email'),$token);
        Parent::h_flash("Link untuk reset password telah dikirim ke email anda.","success");
        return redirect()->back();
      }else{
        Parent::h_flash("Email tersebut tidak terdaftar","warning");
        return redirect()->back();
      }
    }

    public function showResetPassoword($token)
    {
      $email = Crypt::decrypt($token);

      $check = $this->user->where('email',$email)->where('is_on_reset_password',1)->first();
      if(!empty($check)){
        return view('member/reset_password')->with([
          "user_id"=>$check->id
        ]);
      }else{
        Parent::h_flash("Token telah kadarluwarsa, silahkan input kembali.","warning");
        return redirect('forget');
      }
    }

    public function resetPassword(Request $request)
    {
      $message = [
        "kata_sandi.required"  => "Kolom password baru wajib diisi.",
        "kata_sandi.min"       => "Kolom password baru minimal 6 karakter.",
        "kata_sandi.confirmed" => "Kolom password dan konfirmasi password tidak sesuai.",
      ];

      $this->validate($request,[
        "kata_sandi" => "required|min:6|confirmed"
      ],$message);

      $user = $this->user->where('id',$request->input('id'))->first();
      
      if(!empty($user)){
        $user->password =  bcrypt($request->input('kata_sandi'));
        $user->is_on_reset_password =  0;
        $user->save();
        Parent::h_flash("Kata sandi berhasil dirubah, silakan login kembali.","success");
        return redirect('sign');
      }else{
        Parent::h_flash("Token telah kadarluwarsa, silahkan input kembali.","warning");
        return redirect('forget');
      }
    }
  }
