<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Confirm_payment;
use App\Models\Order;
use App\Models\Order_history;
use App\Models\Product_detail;
use App\Jobs\SendUserOrder;
class OrderController extends Controller
{
    public function showOrder()
    {
      return view('administratoronly/commerce/order/index')->with([
        'orders'=>Order::with('order_details')->where('is_deleted','<>',1)->orderBy("created_at","desc")->get()
      ]);
    }

    public function confirmPayment(Request $request)
    {
      $order = Order::findOrFail($request->input('id'));
      \DB::beginTransaction();
      try {
        $order->order_status = 3;
        $order->save();

        Order_history::create([
          "order_id" => $order->id,
          "action"   => "Confirm payment"
        ]);
        \DB::commit();
        if($_SERVER["REMOTE_ADDR"] != "::1"){
          SendUserOrder::dispatch($order->order_no);
        }
        Parent::h_flash('You have successfully confirm payment for this order.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        \DB::rollback();
        dd($e);
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function cancelPayment(Request $request)
    {
      $order = Order::findOrFail($request->input('id'));
      \DB::beginTransaction();
      try {
        $order->order_status = 2;
        $order->save();

        Order_history::create([
          "order_id" => $order->id,
          "action"   => "Cancel payment"
        ]);
        \DB::commit();
        if($_SERVER["REMOTE_ADDR"] != "::1"){
          SendUserOrder::dispatch($order->order_no);
        }
        Parent::h_flash('You have successfully cancelled this order.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        \DB::rollback();
        dd($e);
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function tracking(Request $request)
    {
      $order = Order::findOrFail($request->input('id'));
      \DB::beginTransaction();
      try {
        $order->jne_track = ($request->input('tracking_no') ?? null);
        $order->save();

        if($request->input('tracking_no') != null){
          Order_history::create([
            "order_id" => $order->id,
            "action"   => "Shipped"
          ]);
        }else{
          Order_history::where('order_id',$order->id)->where('action','Shipped')->delete();
        }
        \DB::commit();
        if($_SERVER["REMOTE_ADDR"] != "::1"){
          SendUserOrder::dispatch($order->order_no);
        }
        Parent::h_flash('You have successfully added the tracking data.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        \DB::rollback();
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function showOrderDetail($id)
    {
      $order = Order::findOrFail($id);
      return view('administratoronly/commerce/order/view')->with([
        "order"  => Order::with('billing_province','billing_city','billing_district','shipping_province','order_details.product_detail.product','order_histories','payments')->where('id',$id)->first()
      ]);
    }

    public function showInvoice($id)
    {
      $order = Order::findOrFail($id);
      return view('administratoronly/commerce/order/invoice')->with([
        "order"  => Order::with('billing_province','billing_city','billing_district','shipping_province','shipping_city','shipping_district','order_details.product_detail.product','order_histories','payments')->where('id',$id)->first()
      ]);
    }

    public function deleteOrder(Request $request)
    {
      $order = Order::findOrFail($request->input('id'));
      if($order->order_status == 4)
      {
        try {
          $order->is_deleted = 1;
          $order->save();
          Parent::h_flash('Deleted.','success');
          return redirect()->back();
        } catch (\Exception $e) {
          Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
          return redirect()->back();
        }
      }else{
        Parent::h_flash('Cannot delete, order payment status should canceled.','warning');
        return redirect()->back();
      }

    }
}
