<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
class CategoryController extends Controller
{
    public function showCategory()
    {
      return view('administratoronly/commerce/store/category')->with([
        "categories"=>Category::get()
      ]);
    }

    public function addCategory(Request $request)
    {
      $this->validate($request,[
        "category_name"=>"required|max:50|unique:categories,category_name"
      ]);

      try {
        Category::create([
          "category_name"=>$request->input('category_name'),
          "category_slug"=>str_slug($request->input('category_name'))
        ]);
        Parent::h_flash('You have successfully added the data.','success');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
      return redirect()->back();
    }

    public function editCategory(Request $request)
    {
      $this->validate($request,[
        "category_name"=>"required|max:50|unique:categories,category_name,".$request->input('id')
      ]);

      $category = Category::find($request->input('id'));
      try {
        $category->category_slug = str_slug($request->input('category_name'));
        $category->category_name = $request->input('category_name');
        $category->save();
        Parent::h_flash('You have successfully edited the data.','success');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
      return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
      $category = Category::findOrFail($request->input('id'));
      $subcategory = Subcategory::where('category_id',$category->id)->get();
      $product = Product::whereIn('subcategory_id',array_pluck($subcategory,"id"))->first();
      if(empty($product))
      {
        try {
          $category->delete();
          Parent::h_flash('You have successfully deleted the data.','success');
        } catch (\Exception $e) {
          Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        }
      }else{
        Parent::h_flash('You cannot delete this data as its still in use.'.$product->product_name.'.','warning');
      }

      return redirect()->back();
    }

    public function showSubcategory()
    {
      return view('administratoronly/commerce/store/subcategory')->with([
        "subcategories"=>Subcategory::with('category')->get(),
        "categories"=>Category::orderby('category_name','asc')->get()
      ]);
    }

    public function saveSubcategory(Request $request)
    {
      $this->validate($request,[
        "subcategory_name"=>"required|unique:subcategories,subcategory_name"
      ]);
      try {
        Subcategory::create([
          "category_id"=>$request->input('category'),
          "subcategory_name"=>$request->input('subcategory_name'),
          "subcategory_slug"=>str_slug($request->input('subcategory_name'))
        ]);
        Parent::h_flash('You have successfully added the data.','success');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
      return redirect()->back();
    }

    public function editSubcategory(Request $request)
    {
      $this->validate($request,[
        "subcategory_name"=>"required|unique:subcategories,subcategory_name,".$request->input('id')
      ]);
      $subcategory = Subcategory::findOrFail($request->input('id'));
      try {
        $subcategory->category_id = $request->input('category');
        $subcategory->subcategory_name = $request->input('subcategory_name');
        $subcategory->save();
        Parent::h_flash('You have successfully edited the data.','success');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
      return redirect()->back();
    }

    public function deleteSubcategory(Request $request)
    {
      $subcategory = Subcategory::findOrFail($request->input('id'));
      $product = Product::where('subcategory_id',$subcategory->id)->first();
      if(empty($product))
      {
        try {
          $subcategory->delete();
          Parent::h_flash('You have successfully deleted the data.','success');
        } catch (\Exception $e) {
          Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        }
      }else{
        Parent::h_flash('You cannot delete this data as its still in use.'.$product->product_name.'.','warning');
      }
      return redirect()->back();
    }
}
