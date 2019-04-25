<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        view()->composer('site.components.latestLaws', function ($view) {
            $latestLaws = \App\Models\Article::latestByType(1);
            return $view
                ->with('latestLaws', $latestLaws);
        });
        view()->composer('site.components.latestNews', function ($view) {
            $latestNews = \App\Models\Article::latestByType(0);
            return $view
                ->with('latestNews', $latestNews);
        });
        view()->composer('site.components.latestProjects', function ($view) {
            $latestProjects = \App\Models\Article::latestByType(2);
            return $view
                ->with('latestProjects', $latestProjects);
        });
    }
}
