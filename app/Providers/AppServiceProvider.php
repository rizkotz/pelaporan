<?php

namespace App\Providers;

use App\Models\Level_menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {

            View::share('user', auth()->user());

            if(auth()->check()){
                $level_menus = Level_menu::where('id_level', auth()->user()->id_level)->get();

                $menus = Menu::get();
                View::share([
                    'menus' =>$menus,
                    'level_menus' => $level_menus

                ]);
            }


        });


    }
}
