<div>
  @if(session()->has('message'))
  <div class="flex flex-1 ml-3 mt-2 mb-4 bg-blue-300">
    {{ session('message') }}
  </div>
  @endif
      <div class="flex flex-1 ">
         <div class="flex flex-col flex-1  bg-blue-300 ">
           <form class="mt-2 mb-4" >
             <div class="flex flex-row ml-4 mt-4">
               <div class=" flex flex-1 flex-col ml-6 bg-blue-300">
                 <p class="mb-2">{{__('messages.city')}}</p>
                 <select class="mt-2  " wire:model ="citynames" multiple  >
                   @foreach($citylists as $city)
                     <option class="ml-3 mr-2" value="{{ $city['name'] }} " >
                       {{ $city['name'] }}
                     </option>
                   @endforeach
                 </select>
               </div>

               @if(!empty($value))
               <div class=" flex flex-col ml-6 mr-4 flex-1 ">
                 <p class="mb-2">{{__('messages.field')}}</p>
                 <select class="mt-2 mr-3" wire:model ="codeIds" multiple >
                   @foreach($codelists as $code)
                     <option class="ml-2 mr-3" value="{{ $code['id'] }} " >
                       {{  $code['name'.(strtoupper($value))]  }}
                     </option>
                   @endforeach
                 </select>
               </div>
               @endif
           </div>
             <div class="flex justify-start">
               <div class=" ">
                 <button class="mt-4 mb-4 ml-6 p-2 rounded-md border border-2 border-blue-300 bg-gray-300 hover:bg-blue-100"
                 wire:click.prevent= "submit" >{{__('messages.listbutton')}}</button>
               </div>
               <div class=" ">
                 <input id="searchTemplate" wire:model ="fileName" class=" mt-4 mb-4 ml-6 p-2 rounded-md" type="searchTemplate"
                                             name="fileName"
                                             placeholder=" Save Search Template " />
               </div>
             </div>
          </form>
            @if($proslists)
              <div class="mt-4 mb-4">
                <p>
                  @livewire('prospect.searchlist')
                </p>
              </div>
            @endif
         </div>
      </div>
</div>
