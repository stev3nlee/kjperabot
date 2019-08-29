<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Session;
class RedirectIfNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(User::where('id',Auth::user()->id)->first()->is_verified == 0 ){
          Session::flash('flash_message',"Mohon verifikasi email anda terlebih dahulu.");
          Session::flash('flash_message_level',"danger");
          return redirect('/cart');
        }
        return $next($request);
    }
}
