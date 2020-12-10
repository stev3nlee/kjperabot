<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Auth;
use Session;
use View;
class CartController extends Controller
{
    public function __construct()
    {
      $this->cart = new Cart;
    }

    public function showCart()
    {
      if(Auth::check()){
        $carts = $this->cart->getProduct()->byUserId(Auth::user()->id)->get();
      }else{
        $carts = $this->cart->getProduct()->bySessionId(Session::get('profile_id'))->get();
      }

      if(count($carts) > 0 ){
        return view('checkout.cart')->with([
          "carts"=>$carts
        ]);
      }else{
        return view('checkout.cart-empty');
      }
    }

    public function addToCart(Request $request)
    {
      $product_detail_id=$request->input('product_detail_id');
      //$quantity=($request->input('quantity') == 0 or $request->input('quantity') == null ? 1 : $request->input('quantity'));
      if($request->input('quantity') == 0 or $request->input('quantity') == null){
        $quantity = 1;
      }else{
        $quantity = $request->input('quantity');
      }
      try {
          \DB::beginTransaction();
          if($request->input('cart_id') != null){
            $check = $this->cart->where('id',$request->input('cart_id'))->first();
            $check->delete();
          }
          if(Auth::check()){
            $cart = $this->cart->where(["product_detail_id"=>$product_detail_id,"user_id"=>Auth::user()->id])->first();
            if($cart == null){
              $this->cart->create([
                "product_detail_id" => $product_detail_id
                ,"qty" => ($quantity)
                ,"user_id"=>Auth::user()->id
              ]);
            }else{
              $cart->qty = $quantity;
              $cart->save();
            }
          }else{
            $cart = $this->cart->where(["product_detail_id"=>$product_detail_id,"session_id"=>Session::get('profile_id')])->first();
            if($cart == null){
              $this->cart->create([
                "product_detail_id" => $product_detail_id
                ,"qty" => $quantity
                ,"session_id"=>Session::get('profile_id')
              ]);
            }else{
              $cart->qty = $quantity;
              $cart->save();
            }
          }
          \DB::commit();
      } catch (\Exception $e) {
        \DB::rollback();
      }
      return redirect('cart');
    }

    public function deleteCart(Request $request)
    {
      \DB::beginTransaction();
      $cart = $this->cart->where('id',$request->input('cart_id'))->first();
      try {
        $cart->delete();
        Parent::h_flash('Anda telah berhasil menghapus produk.','success');
        \DB::commit();
      } catch (\Exception $e) {
        Parent::h_flash('Data tersebut error, mohon menghubungi ke KJ Perabot.','danger');
        \DB::rollback();
      }
      return redirect('cart');
    }
}
