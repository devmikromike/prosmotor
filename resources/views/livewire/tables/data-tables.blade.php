<div>
   <div class="">
     @if (session()->has('message'))
           <div class="">
                  {{ session('message') }}
           </div>
     @endif
   </div>

   @if(!empty($data))
    <p> recevived data</p>
        <x-business-card.index :data="['data' => $data]"/>   
        @else
          <p> Here will be data</p>
    @endif
<hr>
</div>
