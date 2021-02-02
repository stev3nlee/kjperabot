<?php

namespace App\Http\Controllers\UserSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use Auth;
class ProductController extends Controller
{

  public function __construct()
  {
    $this->cart           = new Cart;
    $this->product        = new Product;
    $this->user           = new User;
    $this->product_detail = new Product_detail;
    $this->subcategory    = new Subcategory;
    $this->category    = new Category;
    $this->wishlist       = new Wishlist;
  }

  public function showProduct(Request $request,  $category = null, $subcategory = null)
  {
    $limit  = ($request->input('order') ?? 40);
    //$orderby  = ($request->input('urut') == "termahal" ? "desc" : "asc");

    if($request->input('urut')){
      if($request->input('urut') == 'termahal'){
        $orderby = 'desc';
      }else if($request->input('urut') == 'termurah'){
        $orderby = 'asc';
      }else{
        $orderby = 'terbaru';
      }
    }else{
      $orderby = 'asc';
    }

    //$order  = ($request->input('urut') == "termahal" ? "termahal" : "termurah");
    if($request->input('urut')){
      if($request->input('urut') == 'termahal'){
        $order = 'termahal';
      }else if($request->input('urut') == 'termurah'){
        $order = 'termurah';
      }else if($request->input('urut') == 'promo'){
        $order = 'promo';
      }else{
        $order = 'terbaru';
      }
    }else{
      $order = 'termurah';
    }
    $search = ($request->input('q') ?? null);
    $products = $this->product->getProduct();

    if($category!=null and $subcategory==null){
      $category_id = $this->category->where('category_slug',$category)->first();
      $products = $products->byCategory($category_id->id);
    }

    if($subcategory!=null){
      $subcategory_id = $this->subcategory->where('subcategory_slug',$subcategory)->first();
      $products = $products->bySubcategory($subcategory_id->id);
    }

    if($search!= null){
      $products = $products->bySearch($search);
    }

    $data = [];
    if($request->input('urut') == 'promo'){
      $products = $products->where('sale_price','!=',0)->get();
    }else{
      $products = $products->getOrder($orderby)->get();
    }
    
    foreach($products as $product){
      if($product->totalstock > 0){
        $data[] = $product;
      }
    }
    foreach($products as $product){
      if($product->totalstock <= 0){
        $data[] = $product;
      }
    }
    //dd($data);
    $page = request()->has('page') ? request('page') : 1;
    $perPage = $limit;
    $offset = ($page * $perPage) - $perPage;

    $newCollection = collect($data);
        $products = new LengthAwarePaginator(
            $newCollection->slice($offset, $perPage),
            $newCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

    if($search != null and count($products) == 0){
      return view('search-empty')->with([
        "search"=>$search
      ]);
    }

    return view('product')->with([
      "products"=>$products
      ,"limit"=>$limit
      ,"order"=>$order
      ,"search"=>$search
    ]);
  }

  public function showProductDetail(Request $request, $slug,$cart_id = null)
  {
    $product= $this->product->where('slug',$slug)->first();
    //if( count($product) >0 ){
      $details = $this->product_detail->where('product_id',$product->id)->get();
      $total_stock = array_sum(array_pluck($details,"stock"));
      $releated_products = $this->product->where("subcategory_id",$product->subcategory_id)->inRandomOrder()->limit(6)->get();
      if(count($releated_products) < 6){
        $releated_products2 = $this->product->where('subcategory_id','<>',$product->subcategory_id)->inRandomOrder()->limit(6-count($releated_products))->get();
        $releated_products = $releated_products->merge($releated_products2);
      }
      return view('product-detail')->with([
        "product"=>$product
        ,"cart"=>($cart_id != null ? $this->cart->where('id',$cart_id)->first() : null)
        ,"details"=>$details
        ,"total_stock"=>$total_stock
        ,"releated_products"=>$releated_products
      ]);
    //}else{
      return redirect('product');
    //}
  }

  public function addToWishlist(Request $request)
  {
    if(Auth::check()){
      $wishlist = $this->wishlist->firstOrCreate(['product_id'=>$request->input('product_id'),'user_id'=>Auth::user()->id]);
      if($wishlist->wasRecentlyCreated){
        Parent::h_flash("Produk ini berhasil ditambahkan ke wishlist.","success");
      } else {
        Parent::h_flash("Produk ini sudah ada didalam daftar wishlist.","info");
      }
      return redirect()->back();
    }else{
      Parent::h_flash("Anda harus login terlebih dahulu.","info");
      return redirect()->back();
    }
  }
}
