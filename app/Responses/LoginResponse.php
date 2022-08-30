<?php

namespace App\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Log;

class LoginResponse implements LoginResponseContract
{
  public $company = [];

    public function toResponse($request)
    {      
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->route('welcome');
    }
}
