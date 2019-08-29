<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company_profile;
use App\Models\Cart;
use Session;
use Auth;
use URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		//URL::forceScheme('https');
      \View::share([
        "company"=>Company_profile::first()
      ]);

      if(!Session::has('profile_id')){
        Session::put('profile_id',Session::getId());
      }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
