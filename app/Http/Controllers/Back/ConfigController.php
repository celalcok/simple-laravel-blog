<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Str;
class ConfigController extends Controller
{
    public function index(){
        $config=Config::find(1);
        return view('back.configs.index',compact('config'));
    }
    public function update(Request $request){
        $config=Config::find(1);
        // dd($request->post());
        $config->title=$request->title;
        $config->active=$request->active;
        $config->facebook=$request->facebook;
        $config->twitter=$request->twitter;
        $config->instagram=$request->instagram;
        $config->youtube=$request->youtube;
        $config->github=$request->github;
        $config->linkedin=$request->linkedin;
        if($request->hasFile('logo')){
            $logo = Str::slug($config->title).'-logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads'),$logo);
            $config->logo='uploads/'.$logo;
        }
        if($request->hasFile('favicon')){
            $favicon = Str::slug($config->title).'-favicon.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads'),$favicon);
            $config->favicon='uploads/'.$favicon;
        }

        $config->save();
        toastr()->success('Site ayarları başarıyla güncellendi');
        return redirect()->route('admin.config.index');
    }
    public function logosil(){
        $config=Config::find(1);
        $config->logo="";
        $config->save();
        toastr()->success('Logo silindi');
        return redirect()->back();
    }
}
