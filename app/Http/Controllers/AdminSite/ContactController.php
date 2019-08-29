<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company_profile;
use App\Models\Inbox;
class ContactController extends Controller
{
    public function showContact()
    {
      return view('administratoronly/website/contact/index')->with([
        "inboxes"=>Inbox::join('contact_topics','contact_topics.id','inboxes.topic_id')->select("inboxes.*",'contact_topics.topic')->orderBy("inboxes.id","desc")->get(),
        "company"=>Company_profile::first()
      ]);
    }

    public function deleteContact(Request $request)
    {
      try {
        $inbox=Inbox::where('id',$request->input('id'))->first();
        $inbox->delete();
        Parent::h_flash('You have successfully deleted the data.','success');
        return redirect('administratoronly/website/contact');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function editContact(Request $request)
    {
      $this->validate($request,[
        "opening_hours"=>"required|max:50",
        "email"=>"required|email",
        "whatsapp"=>"required",
        "support"=>"required",
        "address"=>"required",
      ]);

      try {
        $company = Company_profile::find(1);
        $company->opening_hour = $request->input('opening_hours');
        $company->email = $request->input('email');
        $company->whatsapp = $request->input('whatsapp');
        $company->support = $request->input('support');
        $company->address = $request->input('address');
        $company->save();
        Parent::h_flash('You have successfully edited the data.','success');
        return redirect('administratoronly/website/contact');
      } catch (\Exception $e) {
		  dd($e);
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }

    }
}
