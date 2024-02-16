<?php

namespace App\Providers;

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
        View::share('user', auth()->user());
        $menusLv1 = menu::get();
        $menusLv2 = menu::where('ketua', '1')->get();
        $menusLv3 = menu::where('anggota', '1')->get();
        View::share([
            'menusLv1' =>$menusLv1,
            'menusLv2' =>$menusLv2,
            'menusLv3' =>$menusLv3,

        ]);
    }
}
