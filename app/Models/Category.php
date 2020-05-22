<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleCount(){
        return $this->hasMany('App\Models\Article','category_id','id')->count();
    }
    public function articleActiveCount(){
        return $this->hasMany('App\Models\Article','category_id','id')->where('status',1)->count();
    }
    public function articlePassiveCount(){
        return $this->hasMany('App\Models\Article','category_id','id')->where('status',0)->count();
    }
}
