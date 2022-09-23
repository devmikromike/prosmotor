<div class=" bg-blue-500 ">
   <div class="flex justify-between items-center">
     <div class="flex justify-left items-center">
       <span class="ml-4 mr-4 mt-2 mb-4 text-lg text-white items-center ">
         MikroMike ProspectMotor v.0.1.3.11-7
         @env('local')
         (Local) -
         @endenv
         (alpha)

       </span>

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

       @endif
       <br>
       Company Name :  {{ session()->get('user.companyName') }}
       Profile id :  {{ session()->get('user.profileId') }}
     </div>
     @if(session('login-success'))
      <div class="alert alert-success" role="alert">
          {{ session('login-success') }}
      </div>
    @endif
       <div class=" ml-4 mr-4 mb-4 p-4">
         <!-- Authentication -->
         <a href="{{ route('logout') }}" class="text-lg text-white mr-4"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             {{__('auth.logout')}}
          </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
             @csrf
            </form>
             <!-- Authentication -->
       </div>
     @endauth
   </div>
</div>
