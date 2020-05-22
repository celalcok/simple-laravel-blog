<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','DESC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // dd($request->post());
            if($request->hasFile('image')){
                $request->validate([
                    'title'=>'min:3',
                    'image'=>'required|image|mimes:jpg,png,jpeg|max:2048',
                ]);
        
            }
            else{
                $request->validate([
                    'title'=>'min:3',
                    'web'=>'min:20'
                ]);
            }
        $article=new Article;
        $article->title=$request->title;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);
        $article->category_id=$request->category;
        $article->image_source=$request->image_source;
        if($request->image_source==0){
            if($request->hasFile('image')){
                $imageName = Str::slug($article->title).'.'.$request->image->extension();  
                $request->image->move(public_path('uploads'), $imageName);
                $article->image='uploads/'.$imageName;
           
            }
        }
        else{
            $article->image=$request->web;
        }

        
        $article->save();
        toastr()->success('Başarılı','Makale başarıyla oluşturuldu');
        return redirect()->route('admin.makaleler.index');
    }
    
    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){
            $request->validate([
                'title'=>'min:3',
                'image'=>'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);
    
        }
        else{
            $request->validate([
                'title'=>'min:3',
                'web'=>'min:20'
            ]);
        }

        $article=Article::findOrFail($id);
        $silinecekResim=$article->image;

        $article->title=$request->title;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);
        $article->category_id=$request->category;
        $article->image_source=$request->image_source;
        if($request->image_source==0){
            if($request->hasFile('image')){
                $imageName = Str::slug($article->title).'.'.$request->image->extension();  
                $request->image->move(public_path('uploads'), $imageName);
                $article->image='uploads/'.$imageName;
                if(File::exists($silinecekResim)){
                    return $silinecekResim;
                    File::delete(public_path($silinecekResim));
                }
            }
        }
        else{
            $article->image=$request->web;
            if(File::exists($silinecekResim)){
                File::delete(public_path($silinecekResim));
            }
        }

        
        $article->save();
        toastr()->success('Makale başarıyla güncellendi','Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request){
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=='true'?1:0;
        $article->save();
        
    }
    public function delete(Request $request)
    {
        // dd($request->post());
        $id=$request->article_id;
        Article::findOrFail($id)->delete();
        toastr()->success($id.' numaralı makale çöp kutusuna taşındı','Başarılı');
        return redirect()->route('admin.makaleler.index');
    }
    public function hardDelete(Request $request)
    {   
        $article=Article::onlyTrashed()->find($request->article_id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
      
        $article->forceDelete();
        toastr()->success('Kalıcı olarak silindi','Başarılı');
        return redirect()->route('admin.trashed.article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $articles=Article::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.articles.trashed',compact('articles'));
    }
    public function recover($id)
    {
        Article::onlyTrashed()->findOrFail($id)->restore();
        toastr()->success('Başarılı','Çöp kutusundan çıkarıldı');
        return redirect()->route('admin.trashed.article');
    }

    public function destroy($id)
    {
        return $id;
    }
}
