<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Models\Rubric;

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
        view()->composer('home', function ($view) {
            $view->with('rubrics', Rubric::all());
        });
    }
}
