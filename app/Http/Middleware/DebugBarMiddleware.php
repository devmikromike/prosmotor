<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugBarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     /**
 * Handle an incoming request.
 *
 * @param \Illuminate\Http\Request $request
 * @param \Closure $next
 * @return mixed
 */
  public function handle(Request $request, Closure $next)
  {
    $local =  config('debugbar.local');
    $remote =  config('debugbar.remote');
  //  $allowd_ips = array();
    $allowd_ips = [];

    foreach ($local as $value) {
       $allowd_ips[] = $value;
    }
    foreach ($remote as $value) {
       $allowd_ips[] = $value;
    }

    if((auth()->user()) or in_array(request()->ip(), $allowd_ips)) {
      echo((request()->ip()));
      dump($allowd_ips);
      \Debugbar::enable();
        dump('Debugbar enabled');
    } else {
      echo((request()->ip()));
        dump('Debugbar disabled');
      \Debugbar::disable();
    }

    return $next($request);
  }

  /*
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    } */
}
