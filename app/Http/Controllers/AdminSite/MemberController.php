<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Order;
use App\Models\Order_detail;
class MemberController extends Controller
{
    public function showMember()
    {
      return view('administratoronly/commerce/member/index')->with([
        "members"=>User::orderBy('id','asc')->get()
      ]);
    }

    public function viewMember($id)
    {
      User::findOrFail($id);
      return view('administratoronly/commerce/member/view')->with([
        "member"=>User::where('id',$id)->with('country','province','city','district')->orderBy('email','asc')->first()
        ,"orders"=>Order::byUser($id)->get()
      ]);
    }

    public function viewMemberOrder($order_no)
    {
      $check=Order::where('order_no',$order_no)->first();
      if(!empty($check)){
        return view('administratoronly/commerce/member/view-order')->with([
          "member"=>User::where('id',$check->user_id)->first(),
          "order"=>Order::where('order_no',$order_no)->with('order_details.product_detail.product','shipping_province','shipping_city','shipping_district','billing_province','billing_city','billing_district')->first(),
          "order_details"=>Order_detail::getProductByOrderId($check->id)->get()
        ])  ;
      }else{
        abort('504');
      }
    }
}
