<?php

use Illuminate\Support\Facades\Route;




// Route::get('admin/image/upload','Back\PageController@upload')->name('admin.image.upload');
// Route::post('admin/image/store','Back\PageController@store')->name('admin.image.store');


/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('IsLogin')->group(function(){
    Route::get('/giris','Back\AuthController@login')->name('login');
    Route::post('/giris','Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('IsAdmin')->group(function(){

    Route::get('/panel','Back\Dashboard@index')->name('dashboard');
    
    // ARTICLE ROUTES
    Route::get('/makaleler/silinenler','Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('/makaleler','Back\ArticleController');
    Route::get('/switch','Back\ArticleController@switch')->name('switch');
    Route::post('/delete','Back\ArticleController@delete')->name('delete.article');
    Route::post('/harddelete','Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recover/{id}','Back\ArticleController@recover')->name('recover.article');
    
    // CATEGORY ROUTES
    Route::get('/kategoriler','Back\CategoryController@index')->name('category.index');
    Route::get('/kategoriler/switch','Back\CategoryController@switch')->name('category.switch');
    Route::post('/kategoriler/store','Back\CategoryController@store')->name('category.store');
    Route::post('/kategoriler/update','Back\CategoryController@update')->name('category.update');
    Route::post('/kategoriler/delete','Back\CategoryController@delete')->name('category.delete');
    Route::get('/kategoriler/getData','Back\CategoryController@getData')->name('category.getdata');

    //PAGE ROUTES
    Route::post('/sayfalar/store','Back\PageController@store')->name('page.store');

    Route::get('/sayfalar','Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/create','Back\PageController@create')->name('page.create');
    Route::get('/sayfalar/silinenler','Back\PageController@trashed')->name('page.trashed');
    Route::get('/sayfalar/switch','Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/edit/{id}','Back\PageController@edit')->name('page.edit');
    Route::post('/sayfalar/update/{id}','Back\PageController@update')->name('page.update');
    Route::get('/sayfalar/delete/{id}','Back\PageController@delete')->name('page.delete');
    Route::get('/sayfalar/siralama','Back\PageController@orders')->name('page.orders');

    //CONFIG ROUTES
    Route::get('/ayarlar','Back\ConfigController@index')->name('config.index');
    Route::post('/ayarlar/update','Back\ConfigController@update')->name('config.update');
    Route::get('/ayarlar/logosil','Back\ConfigController@logosil')->name('config.logosil');
    
    Route::get('/cikis','Back\AuthController@logout')->name('logout');

});
    




/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::get('/site-bakimda',function(){
    return view('front.offline');
});

Route::get('/','Front\HomePage@index')->name('homepage');
Route::get('/kategori/{category}','Front\HomePage@category')->name('category');
Route::get('/iletisim','Front\HomePage@contact')->name('contact');
Route::post('/iletisim','Front\HomePage@contactpost')->name('contact.post');
Route::get('/{category}/{slug}','Front\HomePage@single')->name('single');
Route::get('/{slug}','Front\HomePage@page')->name('page');
