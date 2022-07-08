<div class="">

  <div class="flex flex-row ml-4 mt-4 mb-4 py-2 px-3">
      <div class ="ml-4 mr-2 " >
        <p>  main details</p>
          @if ($showMain)
            @livewire('business-card.main',
               [])
         @endif
      </div>
      <div class="">
          <button  wire:click="openContacts">Contact</button>
      </div>
      <div class="ml-4">
          <button  wire:click="openContacts">details</button>
      </div>
  </div>


  <div class="flex flex-row ml-4 mt-4 mb-4 py-2 px-3">
    @if ($showContacts)
     <div class="  ">
       <p> text inside contact tab </p>
       <div  class="">
         @livewire('business-card.contact',
            [])
       </div>
     </div>
   @endif
  </div>

</div>
