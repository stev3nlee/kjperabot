<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Product;
use App\Models\Subscriber;
use Newsletter;
class NewsletterController extends Controller
{
  public function createCampaign(
    string $fromName,
    string $replyTo,
    string $subject,
    string $html = '',
    string $listName = '',
    array $options = [],
    array $contentOptions = []){

    }

    public function showNewsletter()
    {
      return view('administratoronly/website/newsletter/index')->with([
        "subscribers"=>Subscriber::where('is_subscribe',1)->orderBy('id','desc')->get(),
        "products"  =>Product::orderBy('product_name')->get(),
      ]);
    }

    public function unsubscribe(Request $request)
    {
      $user = User::findOrFail($request->input('id'));
      try {
        $user->is_subscribe = 0;
        $user->save();
        Parent::h_flash('You have successfully deleted the data.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function sendNewsletter(Request $request)
    {
      $this->validate($request,[
        "image"=>"mimes:jpg,jpeg,gif,png",
        "campaign_name"=>"required",
        "template"=>"required",
      ]);
      $filename="";
      if(!empty($request->file('image'))){
        $image = $request->file('image');
        $filename = 'images/uploads/'.strtotime("now").".".$image->getClientOriginalExtension();
        $image->move('images/uploads',$filename);
      }
      $products=array();
      foreach($request->input('products.*') as $id){
        $products[] = Product::where('id',$request->input('products.'.$id))->first();
      }
      //preview
      $data=[
        "campaign_name"=>$request->input('campaign_name'),
        "campaign_image"=>$filename,
        "template"=>$request->input('template'),
        "products"=>$products,
        "hide_product"=>($request->input('hide_product') ?? 0)
      ];

      if($request->input('to') == 2)
      {
        return new \App\Mail\Administrator\Newsletter($data);
      }else{

        $apiKey = \Config::get('newsletter.apiKey');
        $api = Newsletter::getApi();
        $Subscribers= Subscriber::where('is_subscribe',1)->get();
        $url = 'campaigns/4667/actions/send';
        $newsletter = Newsletter::createCampaign(
          "KJPerabot",
          "noreply@kjperabot.co.id",
          $request->input('campaign_name'),
          view('email.newsletter')->with("data",$data)->render(),
          "",
          array(),
          array()
        );
        $api->post('campaigns/'.$newsletter['id'].'/actions/send');
        Parent::h_flash('You have successfully deleted the data.','success');
        return redirect()->back();
      }
    }
}
