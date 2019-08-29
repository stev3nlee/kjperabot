<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
class ArticleController extends Controller
{
    public function showArticle()
    {
      return view('administratoronly/website/article/index')->with([
        "articles"=>Article::orderby('id','desc')->get()
      ]);
    }

    public function viewArticle($id)
    {
      return view('administratoronly/website/article/view')->with([
        "article"=>Article::where('id',$id)->first()
      ]);
    }

    public function addArticle()
    {
      return view('administratoronly/website/article/add');
    }

    public function saveAddArticle(Request $request)
    {
      $this->validate($request,[
        "article_title"=>"required|unique:articles,article_title",
        "image"=>"required|mimes:jpg,jpeg,gif,png",
        "article_content"=>"required"
      ]);

      $image = $request->file('image');
      $filename = "images/uploads/".strtotime("now").".".$image->getClientOriginalExtension();
      $image->move('images/uploads',$filename);

      try {
        Article::create([
          "article_slug"=>str_slug($request->input('article_title')),
          "article_title"=>$request->input('article_title'),
          "image_path"=>$filename,
          "article_content"=>$request->input('article_content'),
        ]);
        Parent::h_flash('You have successfully added the data.','success');
        return redirect('administratoronly/website/article');
      } catch (\Exception $e) {
        dd($e);
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function editArticle($id)
    {
      return view('administratoronly/website/article/edit')->with([
        "article"=>Article::where('id',$id)->first()
      ]);
    }

    public function saveEditArticle(Request $request)
    {
      $this->validate($request,[
        "article_title"=>"required|max:255|unique:articles,article_title,".$request->input('id'),
        "image"=>"mimes:jpg,jpeg,gif,png",
        "article_content"=>"required",
      ]);
      $article=Article::find($request->input('id'));
      $filename=$article->image_path;
      if(!empty($request->file('image'))){
        $image = $request->file('image');
        $filename = "images/uploads/".strtotime("now").".".$image->getClientOriginalExtension();
        $image->move('images/uploads',$filename);
      }

      try {
        $article->article_slug = str_slug($request->input('article_title'));
        $article->article_title = $request->input('article_title');
        $article->image_path = $filename;
        $article->article_content = $request->input('article_content');
        $article->save();
        Parent::h_flash('You have successfully edited the data.','success');
        return redirect('administratoronly/website/article');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }

    public function deleteArticle(Request $request)
    {
      try {
        $article=Article::where('id',$request->input('id'))->first();
        $article->delete();
        Parent::h_flash('You have successfully deleted the data.','success');
        return redirect('administratoronly/website/article');
      } catch (\Exception $e) {
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
        return redirect()->back();
      }
    }
}
