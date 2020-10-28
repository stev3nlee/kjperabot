<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Career;
use App\Models\Category;
use App\Models\Contact_topic;
use App\Models\Inbox;
use App\Models\Page;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Subscriber;
use App\Models\Testimony;

use Newsletter;
use App\Jobs\SendContactUsEmail;
use App\Jobs\SendAdministratorContactUsEmail;
use DB;
class IndexController extends Controller
{

    public function __construct()
    {
      $this->article  = new Article;
      $this->career   = new Career;
      $this->category   = new Category;
      $this->topic   = new Contact_topic;
      $this->page     = new Page;
      $this->product  = new Product;
      $this->product_detail  = new Product_detail;
      $this->slider  = new Slider;
      $this->subcategory  = new Subcategory;
      $this->testimony  = new Testimony;
    }

    public function showIndex()
    {
      return view('index')->with([
        "sliders"=>$this->slider->get()
        ,"hotProduts"=>$this->product->getByHotProduct()->get()
        ,"saleProduts"=>$this->product->getBySaleProduct()->get()
        ,"newProducts"=>$this->product->withCount([
                          'product_details AS total_stock' => function ($query) {
                                      $query->select(DB::raw("SUM(stock) as total_stock"));
                                  }
                              ])->having('total_stock', '>', 0)->orderby("created_at","desc")->limit(4)->get()
        ,"newArticles"=>$this->article->orderby("created_at","desc")->limit(4)->get()
        ,"testimonies"=>$this->testimony->orderby("created_at","desc")->limit(4)->get()
      ]);
    }

    public function showAbout()
    {
      return view('about')->with([
        "page"=>$this->page->where('id',1)->first()
      ]);
    }

    public function showCarrer()
    {
      return view('career')->with([
        "page"=>$this->page->where('id',3)->first(),
        "careers"=>$this->career->where('is_publish',1)->get()
      ]);
    }

    public function showTerm()
    {
      return view('terms-conditions')->with([
        "page"=>$this->page->where('id',2)->first(),
      ]);
    }

    public function showArticle()
    {
      return view('article/list')->with([
        "articles"=>$this->article->orderby("created_at","desc")->paginate(5)
      ]);
    }

    public function showArticleDetail($slug)
    {
      return view('article/detail')->with([
        "article"=>$this->article->where("article_slug",$slug)->first()
      ]);
    }

    public function showContact()
    {
      return view('contact')->with([
        "topics"=>$this->topic->get()
      ]);
    }

    public function saveContact(Request $request)
    {
      $message = [
        "full_name.required" => "Kolom nama lengkap wajib diisi.",
        "full_name.max"  => "Kolom nama lengkap maksimal 50 karakter.",
        "email.required"    => "Kolom email wajib diisi.",
        "email.email"       => "Format email salah.",
        "message.required"  => "Kolom pesan wajib diisi.",
        "topic.required"    => "Kolom topik wajib diisi.",
      ];
      $this->validate($request,[
        "full_name" => "required|max:50",
        "email"=>"required|email"
        ,"message"=>"required"
        ,"topic"=>"required"
      ],$message);

      $data = [
        "full_name"=>$request->input('full_name'),
        "email"=>$request->input('email'),
        "message"=>$request->input('message'),
        "topic_id"=>$request->input('topic')
      ];

      Inbox::create([
        "name"  =>  $request->input('full_name'),
        "email" =>  $request->input('email'),
        "topic_id" =>  $request->input('topic'),
        "message" =>  $request->input('message')
      ]);

      ini_set('max_execution_time', 120);
      if($_SERVER['REMOTE_ADDR'] != "::1"){
        SendContactUsEmail::dispatch($data);
        SendAdministratorContactUsEmail::dispatch($data);
      }
      Parent::h_flash('Tim kami akan membalas dalam 24 Jam. Terima Kasih.','success');
      return redirect()->back();
    }

    public function showCategory()
    {
      return view('category')->with([
        "categories"=>$this->category->with('subcategories')->get()
      ]);
    }

    public function saveNewsletter(Request $request)
    {
      $this->validate($request,[
        "email" => 'required|email'
      ]);
      Newsletter::subscribeOrUpdate($request->input('email'));
      $subscriber = Subscriber::where('email',$request->input('email'))->first();
      if(empty($subscriber)){
        Subscriber::create([
          "email"=>$request->input('email'),
          "is_subscribe"=>1
        ]);
      }else{
        $subscriber->is_subscribe = 1;
        $subscriber->save();
      }
      \Session::flash('flash_message_newsletter','Terima kasih telah berlangganan');
      \Session::flash('flash_message_newsletter_level','success');
      return redirect()->back();
    }

}
