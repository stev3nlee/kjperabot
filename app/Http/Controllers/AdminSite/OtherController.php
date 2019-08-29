<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company_profile;
class OtherController extends Controller
{
    public function showOther()
    {
      return view('administratoronly/commerce/others/index')->with([
        "company" => Company_profile::find(1)
      ]);
    }

    public function saveOther(Request $request)
    {
      $this->validate($request,[
        "tax"=>'numeric|max:100|min:0'
      ]);

      $company = Company_profile::find(1);
      $company->tax_vat = ($request->input('tax')=="" ? 0 : $request->input('tax'));
      $company->free_shipping = ($request->input('free_shipping')=="" ? 0 : $request->input('free_shipping'));
      $company->save();

      Parent::h_flash('You have successfully edited the data.','success');
      return redirect()->back();
    }
}
