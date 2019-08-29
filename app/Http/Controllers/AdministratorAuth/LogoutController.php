<?php

namespace App\Http\Controllers\AdministratorAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LogoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected function guard()
    {
        return Auth::guard('administrator');
    }
    public function logoutToPath(Request $request)
    {
        $activeGuards = 0;
        $this->guard()->logout();

        foreach (config('auth.guards') as $guard => $guardConfig) {
            if ($guardConfig['driver'] === 'session') {
                $guardName = Auth::guard($guard)->getName();
                if ($request->session()->has($guardName) && $request->session()->get($guardName) === Auth::guard($guard)->user()->getAuthIdentifier()) {
                    $activeGuards++;
                }
            }
        }

        if ($activeGuards === 0) {
            $request->session()->flush();
            $request->session()->regenerate();
        }

        return redirect('administratoronly');
    }

}
