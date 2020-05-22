<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Config;

class Dashboard extends Controller
{
    public function index(){
        $config=Config::find(1);
        $article=Article::all()->count();
        $hit=Article::sum('hit');
        $category=category::all()->count();
        $page=Page::all()->count();
        return view('back.dashboard',compact('article','hit','category','page','config'));
    }

}
