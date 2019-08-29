<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\SendVerifyEmail;
use App\Models\Subscriber;
use App\User;
use Auth;
class RegisterController extends Controller
{
    public function createUser(Request $request)
    {
      $message = [
        "email.required" => "Kolom email wajib diisi.",
        "email.email" => "Salah format email.",
        "email.max" => "Kolom email maksimal 255 karakter.",
        "email.unique" => "Email telah terdaftar.",

        "nama_depan.required" => "Kolom nama depan wajib diisi.",
        "nama_depan.max" => "Kolom nama depan maksimal 50 karakter.",

        "nama_belakang.required" => "Kolom nama belakang wajib diisi.",
        "nama_belakang.max" => "Kolom nama depan maksimal 50 karakter.",

        "kata_sandi.required" => "Kolom kata sandi wajib diisi.",
        "kata_sandi.min" => "Kolom kata sandi minimal 6 karakter.",
        "kata_sandi.confirmed" => "Kolom konfirmasi kata sandi tidak sesuai.",

      ];
      $this->validate($request,[
        'email'          => 'required|email|max:255|unique:users,email',
        'nama_depan'     => 'required|max:50',
        'nama_belakang'  => 'required|max:50',
        'kata_sandi'     => 'required|min:6|confirmed',
      ],$message);

      User::create([
          'first_name' => $request->input('nama_depan'),
          'last_name' => $request->input('nama_belakang'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('kata_sandi')),
          'country_id' => '101',
          'is_verified' => '0',
      ]);
      SendVerifyEmail::dispatch($request->input('email'),\Crypt::encrypt($request->input('email')));

      Parent::h_flash("Akun anda berhasil di buat, kami telah mengrimkan sebuah email, segera lakukan verifikasi.","success");
      return redirect()->back();
    }

    public function verifyEmail($token)
    {
      $email = \Crypt::decrypt($token);
      $user = User::where('email',$email)->first();
      if(!empty($user)){
        if($user->is_verified == 0){
          $user->is_verified = 1;
          $user->save();
          Auth::loginUsingId($user->id);
          Parent::h_flash("Anda berhasil melakukan verifikasi email.","success");
          return redirect('profile');
        }else{
          Parent::h_flash("Token tersebut sudah kadarluasa.","danger");
          return redirect('sign');
        }
      }else{
        Parent::h_flash("Token tersebut sudah kadarluasa.","danger");
        return redirect('sign');
      }
    }
}
