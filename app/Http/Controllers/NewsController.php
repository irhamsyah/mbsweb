<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\News;
use App\NewsCategory;
use App\NewsImage;
use App\Logo;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App;
use Auth;
use Validator;
use Hash;
use Image;
use Mail;
use PDF;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Untuk munculkan home setelah register user
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function news_detail_view(Request $request)
     {
       $logos = Logo::all();
       //get id news from url
       $newss = News::select('news.id as news_id','news.title','news.text','news.img_title','news.id_user','news.news_category_id','news_category.name as category_name','users.name as user_name')
       ->leftJoin('news_category', 'news_category.id', '=', 'news.news_category_id')
       ->leftjoin('users', 'users.id', '=', 'news.id_user')
       ->where('id','=',$request->route('id'))
       ->orderBy('news.created_at','desc')->get();

       return view('news_detail.html', ['logos'=> $logos,'newss'=> $newss]);
     }

    public function admin_news()
    {
      $logos = Logo::all();
      $newss = News::select('news.id as news_id','news.title','news.text','news.img_title','news.location','news.id_user','news.news_category_id','news_category.name as category_name','users.name as user_name')
      ->leftJoin('news_category', 'news_category.id', '=', 'news.news_category_id')
      ->leftjoin('users', 'users.id', '=', 'news.id_user')
      ->orderBy('news.created_at','desc')->get();

      //get data newscategory
      $news_categorys = NewsCategory::select('news_category.id','news_category.name')->get();

      return view('admin/news', ['logos'=> $logos,'newss'=> $newss,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_add(Request $request)
    {
      $logos = Logo::all();
      //cek validasi image
        $this->validate($request, [
          'inputImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      //upload image to directory
      if ($request->hasFile('inputImage')) {
          $image = $request->file('inputImage');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/img/news';
          $image->move($destinationPath, $name);
      }
      //input new news
      $newss = new News;
      $newss->title = $request->inputTitle2;
      $newss->text = $request->inputText2;
      $newss->img_title = $name;
      $newss->news_category_id = $request->inputIdCategory;
      $newss->location = $request->inputLanguage;
      $newss->id_user = $request->inputIdUser;
      $newss->created_at = date('Y-m-d H:i:s');
      $newss->save();

      $newss = News::select('news.id as news_id','news.title','news.text','news.img_title','news.location','news.id_user','news.news_category_id','news_category.name as category_name','users.name as user_name')
      ->leftJoin('news_category', 'news_category.id', '=', 'news.news_category_id')
      ->leftjoin('users', 'users.id', '=', 'news.id_user')
      ->orderBy('news.created_at','desc')->get();

      //get data newscategory
      $news_categorys = NewsCategory::select('news_category.id','news_category.name')->get();

      return view('admin/news', ['logos'=> $logos,'newss'=> $newss,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_edit(Request $request)
    {
      $logos = Logo::all();
      if ($request->inputImage!="" OR $request->inputImage!=NULL){
        //cek validasi image
        $this->validate($request, [
            'inputImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //upload image to directory
        if ($request->hasFile('inputImage')) {
            $image = $request->file('inputImage');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/img/news';
            $image->move($destinationPath, $name);
            //delete file image from directory
            unlink($_SERVER['DOCUMENT_ROOT'].'/img/news/'.$request->inputImgOld);
        }
      }else {
        $name = $request->inputImgOld;
      }
      //update news
      //dd($request->inputIdNews);
      $newss = News::find($request->inputIdNews);
      $newss->title = $request->inputTitle1;
      $newss->text = $request->inputText1;
      $newss->img_title = $name;
      $newss->news_category_id = $request->inputIdCategory;
      $newss->location = $request->inputLanguage;
      $newss->id_user = $request->inputIdUser;
      $newss->created_at = date('Y-m-d H:i:s');
      $newss->save();

      $newss = News::select('news.id as news_id','news.title','news.text','news.img_title','news.location','news.id_user','news.news_category_id','news_category.name as category_name','users.name as user_name')
      ->leftJoin('news_category', 'news_category.id', '=', 'news.news_category_id')
      ->leftjoin('users', 'users.id', '=', 'news.id_user')
      ->orderBy('news.created_at','desc')->get();

      //get data newscategory
      $news_categorys = NewsCategory::select('news_category.id','news_category.name')->get();
      return view('admin/news', ['logos'=> $logos,'newss'=> $newss,'news_categorys'=> $news_categorys]);
    }
    //Direct to Proses DeleteNews
    public function admin_news_destroy(Request $request)
    {
      $logos = Logo::all();
      $newss = News::find($request->inputIdNews);
      $newss->delete();

      //delete file image from directory
      unlink($_SERVER['DOCUMENT_ROOT'].'/img/news/'.$request->inputImgOld);

      $newss = News::select('news.id as news_id','news.title','news.text','news.img_title','news.location','news.id_user','news.news_category_id','news_category.name as category_name','users.name as user_name')
      ->leftJoin('news_category', 'news_category.id', '=', 'news.news_category_id')
      ->leftjoin('users', 'users.id', '=', 'news.id_user')
      ->orderBy('news.created_at','desc')->get();

      $news_categorys = NewsCategory::select('news_category.id','news_category.name')->get();
      return view('admin/news', ['logos'=> $logos,'newss'=> $newss,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_category()
    {
      $logos = Logo::all();
      $news_categorys = NewsCategory::select('news_category.id','news_category.name','users.name as user_name')
      ->leftjoin('users','users.id','=','news_category.id_user')->get();
      //dd($news_categorys);
      return view('admin/news_category', ['logos'=> $logos,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_category_add(Request $request)
    {
      $logos = Logo::all();
      //input new news category
      $newscategory = new NewsCategory;
      $newscategory->name = $request->inputNewsCategory;
      $newscategory->id_user = $request->inputIdUser;
      $newscategory->created_at = date('Y-m-d H:i:s');
      $newscategory->save();

      $news_categorys = NewsCategory::select('news_category.id','news_category.name','users.name as user_name')
      ->leftjoin('users','users.id','=','news_category.id_user')->get();

      return view('admin/news_category', ['logos'=> $logos,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_category_edit(Request $request)
    {
      $logos = Logo::all();
      //update news category
      $newscategory = NewsCategory::find($request->inputIdCategory);
      $newscategory->name = $request->inputNewsCategory;
      $newscategory->id_user = $request->inputIdUser;
      $newscategory->created_at = date('Y-m-d H:i:s');
      $newscategory->save();

      $news_categorys = NewsCategory::select('news_category.id','news_category.name','users.name as user_name')
      ->leftjoin('users','users.id','=','news_category.id_user')->get();

      return view('admin/news_category', ['logos'=> $logos,'news_categorys'=> $news_categorys]);
    }
    //Direct to Proses DeleteNewsCategory
    public function admin_news_category_destroy(Request $request)
    {
      $logos = Logo::all();
      //dd($request->inputIdCategory);
      $newscategory = NewsCategory::find($request->inputIdCategory);
      $newscategory->delete();

      $news_categorys = NewsCategory::select('news_category.id','news_category.name','users.name as user_name')
      ->leftjoin('users','users.id','=','news_category.id_user')->get();

      return view('admin/news_category', ['logos'=> $logos,'news_categorys'=> $news_categorys]);
    }
    public function admin_news_image()
    {
      $logos = Logo::all();
      $news_images = NewsImage::select('news_image.id as id_image','news_image.img','news_image.news_id','news.title','users.name as user_name')
      ->leftjoin('news','news.id','=','news_image.news_id')
      ->leftjoin('users','users.id','=','news_image.id_user')->get();

      $newss = News::select('news.id as news_id','news.title')->orderby('news.title')->get();

      return view('admin/news_image', ['logos'=> $logos,'news_images'=> $news_images, 'newss'=> $newss]);
    }
    public function admin_news_image_add(Request $request)
    {
      $logos = Logo::all();
      //cek validasi image
        $this->validate($request, [
          'inputImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      //upload image to directory
      if ($request->hasFile('inputImage')) {
          $image = $request->file('inputImage');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/img/news';
          $image->move($destinationPath, $name);
      }
      //input new news image
      $news_images = new NewsImage;
      $news_images->img = $name;
      $news_images->news_id = $request->inputTitleNews;
      $news_images->id_user = $request->inputIdUser;
      $news_images->created_at = date('Y-m-d H:i:s');
      $news_images->save();

      $news_images = NewsImage::select('news_image.id as id_image','news_image.img','news_image.news_id','news.title','users.name as user_name')
      ->leftjoin('news','news.id','=','news_image.news_id')
      ->leftjoin('users','users.id','=','news_image.id_user')->get();

      $newss = News::select('news.id as news_id','news.title')->orderby('news.title')->get();

      return view('admin/news_image', ['logos'=> $logos,'news_images'=> $news_images, 'newss'=> $newss]);
    }
    public function admin_news_image_edit(Request $request)
    {
      $logos = Logo::all();
      if ($request->inputImage!="" OR $request->inputImage!=NULL){
        //cek validasi image
        $this->validate($request, [
            'inputImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //upload image to directory
        if ($request->hasFile('inputImage')) {
            $image = $request->file('inputImage');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/img/news';
            $image->move($destinationPath, $name);
            //delete file image from directory
            unlink($_SERVER['DOCUMENT_ROOT'].'/img/news/'.$request->inputImgOld);
        }
      }else {
        $name = $request->inputImgOld;
      }
      //input new news image
      $news_images = NewsImage::find($request->inputIdNewsImg);;
      $news_images->img = $name;
      $news_images->news_id = $request->inputTitleNews;
      $news_images->id_user = $request->inputIdUser;
      $news_images->created_at = date('Y-m-d H:i:s');
      $news_images->save();

      $news_images = NewsImage::select('news_image.id as id_image','news_image.img','news_image.news_id','news.title','users.name as user_name')
      ->leftjoin('news','news.id','=','news_image.news_id')
      ->leftjoin('users','users.id','=','news_image.id_user')->get();

      $newss = News::select('news.id as news_id','news.title')->orderby('news.title')->get();

      return view('admin/news_image', ['logos'=> $logos,'news_images'=> $news_images, 'newss'=> $newss]);
    }
    //Direct to Proses DeleteNews
    public function admin_news_image_destroy(Request $request)
    {
      $logos = Logo::all();
      $news_images = NewsImage::find($request->inputIdNewsImg);
      $news_images->delete();

      //delete file image from directory
      unlink($_SERVER['DOCUMENT_ROOT'].'/img/news/'.$request->inputImgOld);

      $news_images = NewsImage::select('news_image.id as id_image','news_image.img','news_image.news_id','news.title','users.name as user_name')
      ->leftjoin('news','news.id','=','news_image.news_id')
      ->leftjoin('users','users.id','=','news_image.id_user')->get();

      $newss = News::select('news.id as news_id','news.title')->orderby('news.title')->get();

      return view('admin/news_image', ['logos'=> $logos,'news_images'=> $news_images, 'newss'=> $newss]);
    }
}
