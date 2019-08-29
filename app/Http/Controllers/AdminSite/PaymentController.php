<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
class PaymentController extends Controller
{
    public function showPayment()
    {
      return view('administratoronly/commerce/payment/index');
    }

    public function viewPayment()
    {
      return view('administratoronly/commerce/payment/view')->with([
        "banks"=>Bank::get()
      ]);
    }
}
