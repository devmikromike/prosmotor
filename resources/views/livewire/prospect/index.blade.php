<div>
  @if(session()->has('message'))
  <div class="flex flex-1 ml-3 mt-2 mb-4 bg-blue-300">
    {{ session('message') }}
  </div>

  @endif
    <p> {{__('Potentiaalisten asiakkaiden lista')}}</p>
    <div class="flex flex-1 ">

       <div class="flex flex-col flex-1  bg-blue-300 ">
         <form class="" >
           <div class="flex flex-row ml-4 mt-4">
             <div class=" flex flex-1 flex-col ml-6 bg-blue-300">
               <p class="mb-2">{{__('Kaupunki lista: ')}}</p>
               <select class="mt-2" wire:model ="citynames" multiple  >

                 @foreach($citylists as $city)
                 
                   <option value="{{ $city['name'] }} " >
                     {{ $city['name'] }}
                   </option>
                 @endforeach
               </select>
             </div>

             <div class=" flex flex-col ml-6 mr-4 flex-1 ">
               <p class="mb-2">{{__('Toimiala lista.')}}</p>
               <select class="mt-2" wire:model ="codeIds" multiple >
                 @foreach($codelists as $code)
                   <option value="{{ $code['id'] }} " >
                     {{ $code['nameFI'] }}
                   </option>
                 @endforeach
               </select>
             </div>
           </div>
           <button wire:click.prevent= "submit" >{{__('Hae listalta.')}}</button>
        </form>
       </div>

    </div>
</div>
