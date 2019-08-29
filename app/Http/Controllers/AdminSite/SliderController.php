<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
class SliderController extends Controller
{
    public function __construct()
    {
      $this->TS = new Slider;
    }

    public function showSlider()
    {
      return view('administratoronly/website/slider/index')->with([
        "sliders"=>$this->TS->orderby('id','desc')->get()
      ]);
    }

    public function addSlider(Request $request)
    {
      $this->validate($request,[
        "image" => "required|mimes:jpg,jpeg,gif,png"
      ]);

      if(!empty($request->file('image'))){
        $image = $request->file('image');
        $filename = strtotime("now").".".$image->getClientOriginalExtension();
        $image->move('images/uploads',$filename);
      }

      try {
        $this->TS->create([
          "image_path"=>'images/uploads/'.$filename
        ]);
        Parent::h_flash('You have successfully added the data.',"success");
        return redirect()->back();
      } catch (\Exception $e) {
        Parent::h_flash('Error, please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function editSlider(Request $request)
    {
      $this->validate($request,[
        "image" => "required|mimes:jpg,jpeg,gif,png"
      ]);

      $slider = $this->TS->where('id',$request->input('id'))->first();
      $image_path = $slider->image_path;
      if(!empty($request->file('image'))){
        $image = $request->file('image');
        $filename = strtotime("now").".".$image->getClientOriginalExtension();
        $image->move('images/uploads',$filename);
        $image_path = "images/uploads/".$filename;
      }

      try {
        $slider->image_path = $image_path;
        $slider->save();
        Parent::h_flash('You have successfully edited the data.',"success");
        return redirect()->back();
      } catch (\Exception $e) {
        Parent::h_flash('Error, please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function deleteSlider(Request $request)
    {
      $slider=$this->TS->where('id',$request->input('id'));
      $slider->delete();
      Parent::h_flash('You have successfully deleted the data.',"success");
      return redirect()->back();
    }
}
