<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    public function index(){
        $pages=Page::all();
        return view('back.pages.index',\compact('pages'));
    }
    public function create(){
        return view('back.pages.create');
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpg,png,jpeg|max:2048',

        ]);

        $last=Page::orderBy('order','desc')->first();
        $page=new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order+1;
        $page->slug=Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName = Str::slug($page->title).'.'.$request->image->extension();  
            $request->image->move(public_path('front/img'), $imageName);
            $page->image='front/img/'.$imageName;
        }
        
        $page->save();
        toastr()->success('Sayfa başarıyla oluşturuldu','Başarılı');
        return redirect()->route('admin.page.index');

    }

    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=='true'?1:0;
        $page->save();
        
    }
    public function edit($id)
    {
        $page=Page::findOrFail($id);
        
        return view('back.pages.update',compact('page'));
    }
    public function orders(Request $request)
    {
        // dd($request->get('page'));
        $orders=$request->get('page');
        foreach ($orders as $key => $order) {
            Page::where('id',$order)->update(['order'=>$key]);
        }

    }
    public function update(Request $request,$id){
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpg,png,jpeg|max:2048',

        ]);

        $page=Page::findOrFail($id);
        $silinecekResim=$page->image;

        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=Str::slug($request->title);        
        if($request->hasFile('image')){
            $imageName = Str::slug($page->title).'.'.$request->image->extension();  
            $request->image->move(public_path('front/img/'), $imageName);
            $page->image='front/img/'.$imageName;
            if(File::exists($silinecekResim)){
                File::delete(public_path($silinecekResim));
            }
           
        }
        
        $page->save();
        toastr()->success('Sayfa başarıyla güncellendi','Başarılı');
        return redirect()->route('admin.page.index');
    }
    public function delete($id)
    {   
        if($id==1){
            toastr()->error('Bu sayfa silinemez','Hata');
            return redirect()->route('admin.page.index');
        }
        else{
            $page=Page::find($id);
            if(File::exists($page->image)){
                File::delete(public_path($page->image));
            }
          
            $page->delete();
            toastr()->success('Sayfa silindi','Başarılı');
            return redirect()->route('admin.page.index');
    
        }
    }


}
