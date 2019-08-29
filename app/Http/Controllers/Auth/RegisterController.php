<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Jobs\SendVerifyEmail;

use App\Models\Subscriber;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/cart';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
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
        return Validator::make($data, [
            'email'          => 'required|email|max:255|unique:users,email',
            'nama_depan'     => 'required|max:50',
            'nama_belakang'  => 'required|max:50',
            'kata_sandi'     => 'required|min:6|confirmed',
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      if(!empty($data['newsletter'])){
        Subscriber::create(['email'=> $data['email']]);
      }
      SendVerifyEmail::dispatch($data['email'],\Crypt::encrypt($data['email']));
        return User::create([
            'first_name' => $data['nama_depan'],
            'last_name' => $data['nama_belakang'],
            'email' => $data['email'],
            'password' => bcrypt($data['kata_sandi']),
            'country_id' => '101',
        ]);
    }
}
