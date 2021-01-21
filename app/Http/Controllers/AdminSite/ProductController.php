<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Subcategory;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_detail;
class ProductController extends Controller
{
    public function showProduct()
    {
      return view('administratoronly/commerce/product/index')->with([
        "products"=>Product::with('subcategory.category')->orderby('id','desc')->get()
      ]);
    }

    public function showAddProduct()
    {
      return view('administratoronly/commerce/product/add')->with([
        "categories" => Category::orderBy('category_name','asc')->get(),
        "subcategories" => Subcategory::orderBy('subcategory_name','asc')->get(),
      ]);
    }

    public function saveProduct(Request $request)
    {
      $this->validate($request,[
        "category"=>"required|not_in:0",
        "subcategory"=>"required|not_in:0",
        "product_code"=>"required|unique:products,product_code|max:100",
        "product_name"=>"required|unique:products,product_name|max:100",
        "price"   =>"required|numeric|min:0",
        "weight"   =>"required|numeric|min:0.1",
        "product_description"=>"required",
        'image'     => 'required',
        'image.*.*'     => 'mimes:jpg,jpeg,gif,png',
        'stock.*'     => 'required|numeric',
        'color.*'     => 'required',
      ]);

      $images="";
        foreach($request->file('image.*') as $image)
        {
          $filename = md5($image->getClientOriginalName()).".".$image->getClientOriginalExtension();
          $image->move('images/uploads',$filename);
          $images.="images/uploads/".$filename."::";
        }

        $discount_amount = 0;
        if($request->input('sale_price')){
          if($request->input('sale_price') > $request->input('price')){
            Parent::h_flash('Sale price cannot be higher than product price.','danger');
            return redirect()->back();
          }
          $discount_amount = $request->input('price') - $request->input('sale_price');
        }

      try {
        \DB::beginTransaction();
        $product=Product::create([
          "slug"    =>str_slug($request->input('product_name'))
          ,"product_name"    =>$request->input('product_name')
          ,"product_code"   =>$request->input('product_code')
          ,"subcategory_id" =>$request->input('subcategory')
          ,"product_price"  =>$request->input('price')
          ,"product_description" =>$request->input('product_description')
          ,"image_path"     =>$images
          ,"sale"           =>($request->input('sale') == "" ? 0 : $request->input('sale'))
          ,"sale_price"     =>($request->input('sale_price') == "" ? 0 : $request->input('sale_price'))
          ,"weight"         =>($request->input('weight') ?? 0)
          ,"discount_amount"=>$discount_amount
        ]);

        $data=array();
        foreach($request->input('color.*') as $index => $value){
          $data[]=[
            "product_id"=>$product->id,
            "color"     =>ucwords(strtolower($value)),
            "stock"     =>$request->input('stock.'.$index)
          ];
        }

        Product_detail::insert($data);
        \DB::commit();
        Parent::h_flash('You have successfully added new product.','success');
        return redirect('administratoronly/commerce/product');
      } catch (\Exception $e) {
        \DB::rollback();				dd($e);
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function viewProduct($id)
    {
      $product = Product::findOrFail($id);

      return view('administratoronly/commerce/product/view')->with([
        "product"=>Product::with('product_details')->where('id',$id)->first()
      ]);
    }

    public function showEditProduct($id)
    {
      $product = Product::findOrFail($id);

      return view('administratoronly/commerce/product/edit')->with([
        "product"=>Product::with('product_details')->where('id',$id)->first(),
        "categories" => Category::orderBy('category_name','asc')->get(),
        "subcategories" => Subcategory::orderBy('subcategory_name','asc')->get(),
      ]);
    }

    public function editProduct(Request $request)
    {
      $product = Product::findOrFail($request->input('id'));

      $this->validate($request,[
        "category"=>"required|not_in:0",
        "subcategory"=>"required|not_in:0",
        "product_code"=>"required|unique:products,product_code,".$request->input('id')."|max:100",
        "product_name"=>"required|unique:products,product_name,".$request->input('id')."|max:100",
        "price"   =>"required|numeric|min:0",
        "weight"    =>"required|numeric|min:0.1",
        "product_description"=>"required",
      ]);

      $discount_amount = 0;
      if($request->input('sale_price')){
        if($request->input('sale_price') > $request->input('price')){
            Parent::h_flash('Sale price cannot be higher than product price.','danger');
            return redirect()->back();
        }
        $discount_amount = $request->input('price') - $request->input('sale_price');
      }

      $images=$product->image_path;
      if(!empty($request->file('image.*')))
      {
        $this->validate($request,[
          'image.*'     => 'mimes:jpg,jpeg,gif,png',
        ]);
        $images="";
        foreach($request->file('image.*') as $image)
        {
          $filename = md5($image->getClientOriginalName()).".".$image->getClientOriginalExtension();
          $image->move('images/uploads',$filename);
          $images.="images/uploads/".$filename."::";
        }
      }

      try {
        $product->slug          = str_slug($request->input('product_name'));
        $product->product_name  = $request->input('product_name');
        $product->product_code  = $request->input('product_code');
        $product->image_path  = $images;
        $product->subcategory_id  = $request->input('subcategory');
        $product->product_price  = $request->input('price');
        $product->product_description  = $request->input('product_description');
        $product->sale  = ($request->input('sale') ?? 0);
        $product->sale_price  = ($request->input('sale_price') == "" ? 0 : $request->input('sale_price'));
        $product->weight  = $request->input('weight');
        $product->discount_amount  = $discount_amount;
        $product->save();
        Parent::h_flash('You have successfully edited this product.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function addColor(Request $request)
    {
      $product = Product::findOrFail($request->input('id'));
      try {
        Product_detail::create([
          "product_id"=>$product->id,
          "color"=>"New Color",
          "stock"=>0,
        ]);
        Parent::h_flash('You have successfully added new color.','success');
        return redirect()->back();
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function deleteColor(Request $request)
    {
      $order = Order_detail::where('product_detail_id',$request->input('id'))->first();
      if(empty($order)){
        $product = Product_detail::findOrFail($request->input('id'));
        try {
          \DB::beginTransaction();
          $product->delete();
          Cart::where('product_detail_id',$request->input('id'))->delete();
          \DB::commit();
          Parent::h_flash('You have successfully deleted this color.','success');
          return redirect()->back();
        } catch (\Exception $e) {
          \DB::rollback();
          Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
          return redirect()->back();
        }
      }else{
        Parent::h_flash('You cannot delete this color as this product has already been ordered.','warning');
        return redirect()->back();
      }
    }

    public function editDetail(Request $request)
    {
      $this->validate($request,[
        'stock.*'     => 'required|numeric',
        'color.*'     => 'required',
      ]);
      $ids = $request->input('product_detail_id.*');

      try {
        foreach($ids as $key => $val){
          Product_detail::where('id',$val)->update([
            "stock" =>$request->input('stock.'.$key),
            "color" =>$request->input('color.'.$key),
          ]);
        }
        Parent::h_flash('You have successfully edited this product.','success');
        return redirect()->back();
      } catch (Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function deleteProduct(Request $request)
    {
      $product = Product::findOrFail($request->input('id'));
      $product_detail = Product_detail::where('product_id',$product->id)->pluck('id');
      // $order = Order_detail::leftjoin('orders','order_details.order_id','=','orders.id')->whereIn('order_details.product_detail_id',$product_detail)->where('order_status','<',4)->whereNull('jne_track')->first();
      // if(empty($order)){
        \DB::beginTransaction();
        try {
          $product->delete();
          Product_detail::whereIn('product_id',$product_detail)->delete();
          \DB::commit();
          Parent::h_flash('You have successfully deleted this product.','success');
          return redirect()->back();
        } catch (\Exception $e) {
          \DB::rollback();
          Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
          return redirect()->back();
        }
      // }else{
      //   Parent::h_flash('You cannot delete this color as this product has already been ordered.','warning');
      //   return redirect()->back();
      // }
    }
}
