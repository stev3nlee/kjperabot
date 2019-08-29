<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Page;
class CareerController extends Controller
{
    public function __construct()
    {

    }

    public function showCareer()
    {
      return view('administratoronly/website/career/index')->with([
        "page"=>Page::where('id',3)->first()
        ,"careers"=>Career::orderBy('id','desc')->get()
      ]);
    }

    public function savePage(Request $request)
    {
      $this->validate($request,[
        "page_description"=>"required"
      ]);

      try {
        Page::where('id',3)->update([
          "page_description"=>$request->input('page_description')
        ]);
        Parent::h_flash('You have successfully edited the data.','success');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
      return redirect()->back();
    }

    public function viewCareer($id)
    {
      return view('administratoronly/website/career/view')->with([
        "career"=>Career::where('id',$id)->first()
      ]);
    }

    public function addCareer()
    {
      return view('administratoronly/website/career/add');
    }

    public function saveCareer(Request $request)
    {
      $this->validate($request,[
        "job_name"=>"required|max:50",
        "job_requirement"=>"required",
        "job_responsibility"=>"required",
      ]);
      try {
        Career::create([
          "job_name"=>$request->input('job_name'),
          "requirement"=>$request->input('job_requirement'),
          "responsibility"=>$request->input('job_responsibility'),
          "is_publish"=>($request->input('is_publish') ?? 0)
        ]);
        Parent::h_flash('You have successfully added the data.','success');
        return redirect('administratoronly/website/career');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function editCareer($id)
    {
      return view('administratoronly/website/career/edit')->with([
        "career"=>Career::where('id',$id)->first()
      ]);
    }

    public function saveEditCareer(Request $request)
    {
      $this->validate($request,[
        "job_name"=>"required|max:50|unique:careers,job_name,".$request->input('id'),
        "job_requirement"=>"required",
        "job_responsibility"=>"required",
      ]);
      try {
        $career=Career::where('id',$request->input('id'))->first();
        $career->job_name = $request->input('job_name');
        $career->requirement = $request->input('job_requirement');
        $career->responsibility = $request->input('job_responsibility');
        $career->is_publish = ($request->input('is_publish') ?? 0);
        $career->save();
        Parent::h_flash('You have successfully edited the data.','success');
        return redirect('administratoronly/website/career');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function deleteCareer(Request $request)
    {
      try {
        $career=Career::where('id',$request->input('id'))->first();
        $career->delete();
        Parent::h_flash('You have successfully deleted the data.','success');
        return redirect('administratoronly/website/career');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }
}
