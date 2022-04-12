<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Bus\Queueable;

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
      /*
        Queue::failing(function (JobFailed $event) {
           $event->connectionName
           $event->job
           $event->data
     });    */


        //
        /*
        view()->composer('welcome', function($view){
          $view->with('searchBar', \App\Models\CityList::citySearch($city));
        }); */
    }
}
