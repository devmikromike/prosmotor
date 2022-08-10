<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if(Session()->get('applocale') == App::getLocale())
        {
         return $next($request);
        }
          if($request->locale !== null   ){
            if(Session()->has('applocale') && Session()->get('applocale')  !== $request->locale){
             App::setLocale(Session()->get('applocale'));
               return $next($request);
                 }else {
                   App::setLocale( ($request->locale));
                   Log::info('message request has  '.$request->locale );
                        return $next($request);
                 }

          }else {
            if (  Session()->has('applocale') AND array_key_exists(Session()->get('applocale'), config('languages')))
                 {
                   $locale =   App::setLocale(Session()->get('applocale'));
                     Log::info('message session set '.$locale );
                          return $next($request);
               }else {
                 Log::info('message outside range both failed!');
                   App::setLocale( 'fi');
                   Session(['applocale']);
               Log::info('both set!');
               }
          }
        return $next($request);
    }
}
