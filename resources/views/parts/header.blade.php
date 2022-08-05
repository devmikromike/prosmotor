<div class=" bg-blue-500 ">
   <div class="flex justify-between items-center">
     <div class="flex justify-left items-center">
       <span class="ml-4 mr-4 mt-2 mb-4 text-lg text-white items-center ">
         MikroMike ProspectMotor v.0.1.3.11-3
         @env('local')
         (Local) -
         @endenv
         (alpha)
         -        {{ session()->get('applocale') }} - {{ App::getLocale() }}
       </span>
       <div class="flex text-lg text-white mt-2 ml-4 mr-4 mb-4">
             @foreach (Config::get('languages') as $lang => $language)
               @if ($lang  != App::getLocale())
               {{  Config::get('languages')[App::getLocale()]['message']}}
              <div class="mr-4 ml-4  ">
                   <a class="flex" href="{{ route('lang.switch', $lang) }}">
                 {{ Config::get('languages')[App::getLocale()]['display'] }}
                   <div class="mb-1">
                   <img src="{{ asset('icon/'.Config::get('languages')[App::getLocale()]['flag-icon'].'.' .'svg') }}"
                          width="10" height="10"/>
                  </div>
                  </a>
             </div>
              @endif
           @endforeach
        </div>
        <div class="">
          @auth
            @env('local')
            <p>  {{__('env.auth.local')}} </p>
            @endenv
          @endauth
          @guest
            @env('local')
            <p>  {{__('env.local')}} </p>
            @endenv
            @env('alpha')
            <p>  {{__('env.alpha')}} </p>
            @endenv
          @endguest
        </div>
     </div>
     @auth
     <div class="text-white">
       @if(Auth::user()->username ===  env('ADMIN_USER') )
        {{  Auth::user()->username }}
        @else
        {{  Auth::user()->username }}

        Company Name :  {{ session()->get('user.companyName') }}
       @endif
       <br>
     </div>
       <div class=" ml-4 mr-4 mb-4 p-4">
         <!-- Authentication -->
         <a href="{{ route('logout') }}" class="text-lg text-white mr-4"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             {{__('auth.logout')}}
          </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
             @csrf
            </form>
       </div>
     @endauth
   </div>
</div>
