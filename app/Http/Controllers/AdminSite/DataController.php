<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class DataController extends Controller
{
  public function __construct()
  {
    
  }
  public function setAdminData(Request $request,$comment_id=null)
  {
    $id = Auth::guard('administrator')->user()->id;
    Administrator::where('id',$id)->update([
      "ip_address"=>$request->ip()
      ,"browser_agent"=>$request->server('HTTP_USER_AGENT')
      ,"last_login"=>date("Y-m-d H:i")
    ]);
    return redirect('administratoronly/dashboard');
  }
}
