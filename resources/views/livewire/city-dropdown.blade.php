  <div class=" ">

    @if(!empty($citynames))
       <select class="mt-2 mb-4" value ="" wire:model = "selectedCity">
           <option class="mr-4" value="" selected>{{__('Kaikki Kaupungit')}} </option>
          @foreach($citynames as $city)

            @if(!empty($city))
                <option class="mr-4" value="{{$city}}">
                   {{$city->name}}
              </option>
              @endif
          @endforeach
      </select>
    @endif
  </div>
