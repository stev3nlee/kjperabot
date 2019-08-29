<?php

namespace App\Providers;
use App\Models\Cart;
use Auth;
use View;
use Session;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

      View::composer('*', function($view){
        $view->with([
            'cart_count'=>(Auth::check() ? Cart::where('user_id',Auth::user()->id)->count() : Cart::where('session_id',Session::get('profile_id'))->count())
            ,"order_color"=>[1=>"yellow",2=>"blue",3=>"green",4=>"red",5=>"refund"]
            ,"order_string"=>[1=>"Pending",2=>"Sedang diproses",3=>"Sukses",4=>"Batal",5=>"Refund"]
        ]);
      });

      View::composer('administratoronly.*', function($view){
        if(Auth::guard('administrator')->check()){
          $data=\App\Models\Role::where('id',Auth::guard('administrator')->user()->role_id)->select('role_access')->first();
          $view->with([
              "userRoles" => explode("&&",$data['role_access'])
          ]);
        }
      });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
