<div class=" bg-blue-500 ">
 <div class="flex justify-between items-center">
   <span class="ml-4 mt-2 mb-4 text-lg text-white">
     MikroMike ProspectMotor v.0.1.3.11-1(alpha)
   </span>
   @auth
     <div class=" ml-4 mr-4  p-4">
       <!-- Authentication -->
       <a href="{{ route('logout') }}" class="text-lg text-white mr-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           {{__('auth.logout')}}
        </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
           @csrf
          </form>

     </div>
   @endauth
 </div>

</div>
