<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Cart;
class RedirectIfNoCart
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
        if(Cart::where('user_id',Auth::user()->id)->count() == 0){
          return redirect('/cart');
        }
        return $next($request);
    }
}
