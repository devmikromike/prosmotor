
 <x-landingpage>
   @include('parts.header')
   @include('parts.message')
     <x-landingpage.header>

               <span class="container text-center font-semibold text-xl bg-gray-300 mx-auto mb-3 " >
                 {{__('messages.header')}} <br>
                 {{__('messages.headerline2')}}<br>
                  <p class="mt-2">{{__('messages.subheader')}}</p>
                </span>

     </x-landingpage.header>
     <div class="flex flex-row ">
       <div class="basis-1/4">
         <aside id="sidebar" aria-label="Sidebar"
          class="px-3 py-2 bordr border-2
          border-blue-200  bg-blue-300">
           @livewire('sidebar')
         </aside>
       </div>
       <div class="px-6 py-2 mx-4 text-center font-semibold text-xl basis-1/2">
          <div class="">
               @livewire('tables.table')
          </div>
       </div>
   </div>
</x-landingpage>
