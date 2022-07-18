<?php

namespace App\Macros;

/**
 *
 */
class AdminMacros
{
  public function isAdmin()
  {
    Blade::if( 'admin', function(){
      return auth()->user()->isAdmin();
    });
  }
}
