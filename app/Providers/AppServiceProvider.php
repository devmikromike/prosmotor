<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Bus\Queueable;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Query\Builder;
Use App\Models\Role;
Use App\Models\User;
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
       Blade::directive('role', function ($value) {

      // $user = User::findRole($value, auth()->user()->id);

          if(auth()->check()){
            $userId = auth()->user()->id;
            $user = User::findRole($value, $userId);
              return $user;
          }
      });

      Blade::directive('endrole', function () {

      });
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
