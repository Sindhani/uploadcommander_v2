<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\HelpDesk;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menu = HelpDesk::where('is_menu',1)->where('is_active',1)->get();
        $child = HelpDesk::where('is_menu',0)->where('is_active',1)->get();
        $menu1 = HelpDesk::where('is_menu',1)->where('is_active',1)->get();
        $child1 = HelpDesk::where('is_menu',0)->where('is_active',1)->get();
        view()->share(['menu'=>$menu,'child'=>$child, 'menu1'=>$menu1,'child1'=>$child1]);
    }
}
