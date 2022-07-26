

 <div class="container mx-auto px-4 text-left flex flex-row ">
   <div class=" mt-4 pb-2 ">
     <div class="mt-3 mb-2">
       <x-menu.link route="landingpage" title="LandingPage">
           <label for="landingpage">LandingPage</label>
       </x-menu.link>
     </div>
     <div class="border border-3 border-blue-300 ">
                  <p> {{__('search.title')}} </p>

    <button type="button"
       wire:click="$toggle('showDiv')"
       class="px-4 py-2 font-bold text-purple-100 bg-purple-500">
       How & hide div
     </button>


      <x-menu.link route="byVatId" nameLink="vatId">
          <label for="vatId">{{__('search.vatid')}}</label>
      </x-menu.link>

     </div>
   </div>
 </div>
