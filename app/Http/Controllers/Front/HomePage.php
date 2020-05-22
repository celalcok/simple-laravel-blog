<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Mail;
// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class HomePage extends Controller
{
    public function __construct(){
        if(Config::find(1)->active==0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->orderBy('name','asc')->get());
        view()->share('config',Config::find(1));
    }
    public function index(){
        $data['articles']=Article::where('status',1)->with('getCategory')->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(10);
        // dd($data['articles']);   
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category=Category::where('slug',$category)->first()??abort(403,'Böyle bir kategori bulunamadı');
        $article=Article::where('slug',$slug)->where('category_id',$category->id)->first()??abort(403,'Böyle bir yazı bulunamadı');
        $article->increment('hit');
        $data['article']=$article;
        return view('front.single',$data);
    }
    
    public function category($slug){
        $category=Category::where('slug',$slug)->first()??abort(403,'Böyle bir kategori bulunamadı');
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(10);
        return view('front.category',$data);
    }
    
    public function page($slug){
       
        $page=Page::where('slug',$slug)->where('status',1)->first()??abort(403,'Böyle bir sayfa bulunamadı');
        $data['page']=$page;
        return view('front.page',$data);    
    }
    public function contact(){
        return view('front.contact');
    }
    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);

        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([],[], function($message) use($request){
           $message->from('iletisim@blogsitesi.com','School');
           $message->to('74a08fcd2a-150d5e@inbox.mailtrap.io','Teacher');
           $message->subject($request->name.' iletişimden mesaj gönderdi');
           $message->setBody(' Mesajı gönderen: '.$request->name.'<br>
           Mesajı gönderen Mail: '.$request->email.'<br>
           Mesaj Konusu: '.$request->topic.'<br>
           Mesaj: '.$request->message.'<br><br>
           Mesaj Gönderilme Tarihi: '.now().'','text/html');
        });
        return redirect()->route('contact')->with('success','Mesajınız bize iletildi. Teşekkür ederiz');    
    }

    // public function contactpost(Request $request){
    //     $rules=[
    //         'name'=>'required|min:5',
    //         'email'=>'required|email',
    //         'topic'=>'required',
    //         'message'=>'required|min:10'
    //     ];
    //     $validate=Validator::make($request->post(),$rules);

    //     if($validate->fails()){
    //         return redirect()->route('contact')->withErrors($validate)->withInput();
    //     }

    //     $contact=new Contact;
    //     $contact->name=$request->name;
    //     $contact->email=$request->email;
    //     $contact->topic=$request->topic;
    //     $contact->message=$request->message;
    //     $contact->save();
    //     return redirect()->route('contact')->with('success','Mesajınız bize iletildi. Teşekkür ederiz');    
    // }


}
