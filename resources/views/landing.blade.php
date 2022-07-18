 @extends('layouts.public')
   @section ('body')
      <header>
        <div class="flex flex-col mt-4">
              <span class="container text-center font-semibold text-xl bg-gray-300 mx-auto mb-3 " >
                {{__('messages.header')}} <br>
                {{__('messages.headerline2')}}<br>
                 <p class="mt-2">{{__('messages.subheader')}}</p>
               </span>
        </div>
      </header>
      <div class="flex flex-row ">
        <div class="basis-1/4">
          <aside id="sidebar" class="px-6 py-2 bordr border-2 border-blue-200
                                    bg-blue-300">
             @include('parts.sidebar')
          </aside>
        </div>
        <div class="px-6 py-2 mx-4 text-center font-semibold text-xl basis-1/2">
               @include('landingpage.home')
        </div>
      </div>



   @endsection
