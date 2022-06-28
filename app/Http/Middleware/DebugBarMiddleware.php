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

    foreach ($local as $value) {
       $allowd_ips[] = $value;
    }
    foreach ($remote as $value) {
       $allowd_ips[] = $value;
    }
     if( in_array(request()->ip(), $allowd_ips) or (auth()->user()) ) {
//  if( (auth()->user()) ) {
       config(['app.debug' => true]);
     \Debugbar::enable();
      \Artisan::call('cache:clear');

      } else {
         \Debugbar::disable();
      }

    return $next($request);
  }
}
