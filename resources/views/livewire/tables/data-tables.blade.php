
<div>
   <div class="">
       @if (session()->has('message'))
             <div class="">
                    {{ session('message') }}
             </div>
       @endif
   </div>
     @if(!empty($data))
             <x-business-card.index :data="['data' => $data]"/>
          @else

          @auth
           <div class=" mb-4 border bordr-2 ">
              @livewire('prospect.index')
           </div>
         @endauth
         <p> Here will be data</p>
      @endif
</div>
