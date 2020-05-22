<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Config;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // view()->share('config', Config::find(1));
        // Route::resourceVerbs([
        //     'create'=>'olustur',
        //     'edit'=>'duzenle',
        //     'update'=>'guncelle',
        //     'store'=>'kaydet'
        // ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
