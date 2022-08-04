<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Bus\Queueable;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Query\Builder;
use App\Macros\SearchMacros;

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
     public function boot()
   {
     /*
       Blade::if('admin', function () {
          if (auth()->user() && auth()->user()->admin) {
              return 1;
          }
          return 0;
      });    */
/*
      Builder::macro('search', function(){
        return $this->->where($attribute,  'LIKE', "%{$searchTerm}%");
      }); */

      $this->app->singleton(
             \App\Responses\LoginResponse::class
         );

      Builder::mixin(new SearchMacros);
   }

}
