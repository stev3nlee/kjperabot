<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
class PageController extends Controller
{
    public function __construct()
    {
      $this->TP = new Page;
    }

    public function showPage()
    {
      return view('administratoronly/website/pages/index')->with([
        "pages"=>$this->TP->where('id','<>',3)->get()
      ]);
    }

    public function viewPage(Request $request,$id)
    {
      $page=$this->TP->where('id',$id)->first();
      if(!empty($page)){
        return view('administratoronly/website/pages/view')->with([
          "page"=>$page
        ]);
      }else{
        Parent::h_flash("Request is not found.","danger");
        return redirect()->back();
      }
    }

    public function editPage(Request $request,$id)
    {
      $page=$this->TP->where('id',$id)->first();
      if(!empty($page)){
        return view('administratoronly/website/pages/edit')->with([
          "page"=>$page
        ]);
      }else{
        Parent::h_flash("Request is not found.","danger");
        return redirect()->back();
      }
    }

    public function saveEditPage(Request $request)
    {
      try {
        $page = $this->TP->where('id',$request->input('id'))->first();
        $page->page_description = $request->input('page_content');
        $page->save();
        Parent::h_flash('You have successfully edited the data.','success');
        return redirect('/administratoronly/website/pages');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }
}
