<div>
  @if(session()->has('message'))
  <div class="flex flex-1 ml-3 mt-2 mb-4 bg-blue-300">
    {{ session('message') }}
  </div>
  @endif

    <p> {{__('messages.listheader')}}</p>

      <div class="flex flex-1 ">
         <div class="flex flex-col flex-1  bg-blue-300 ">
           <form class="" >
             <div class="flex flex-row ml-4 mt-4">
               <div class=" flex flex-1 flex-col ml-6 bg-blue-300">
                 <p class="mb-2">{{__('messages.city')}}</p>
                 <select class="mt-2" wire:model ="citynames" multiple  >
                   @foreach($citylists as $city)
                     <option value="{{ $city['name'] }} " >
                       {{ $city['name'] }}
                     </option>
                   @endforeach
                 </select>
               </div>

               @if(session()->has('applocale')) 
               <div class=" flex flex-col ml-6 mr-4 flex-1 ">
                 <p class="mb-2">{{__('messages.field')}}</p>
                 <select class="mt-2" wire:model ="codeIds" multiple >
                   @foreach($codelists as $code)
                     <option value="{{ $code['id'] }} " >
                       {{  $code['name'.strtoupper(session('applocale'))]  }}
                     </option>
                   @endforeach
                 </select>
               </div>
               @endif
             </div>
             <button class="mt-4 mb-4 ml-6 p-2 rounded-md border border-2 border-blue-300 bg-gray-300 hover:bg-blue-100"
             wire:click.prevent= "submit" >{{__('messages.listbutton')}}</button>
          </form>
         </div>
      </div>
</div>
