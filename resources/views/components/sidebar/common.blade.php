
 <div class="container mx-auto px-4 text-left flex flex-row ">
   <div class=" mt-4 pb-2 ">
     <div class="mt-3 mb-2">
       <x-menu.link route="landingpage" title="LandingPage">
           <label for="landingpage">LandingPage</label>
       </x-menu.link>
     </div>
     <div class="border border-3 border-blue-300 ">
                  <p> {{__('search.title')}} </p>

            <x-menu.link route="byVatId">
                <label for="vatId">{{__('search.vatid')}}</label>
            </x-menu.link>
     </div>
     <div class="  border border-2 border-blue-300">
       <p>A.2</p>
     </div>
     <div class="  border border-2 border-blue-300">
       <p>A.3.1</p>
     </div>
   </div>
 </div>
