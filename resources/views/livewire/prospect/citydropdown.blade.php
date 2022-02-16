  <div class=" ">
    @if(!empty($newcitylist))
       <select class="mt-2 mb-4" value ="" wire:model = "selectedCity">
           <option class="mr-4" value="" selected>{{__('Kaikki Kaupungit')}} </option>
          @foreach($newcitylist as $city)
              @if(!empty($city))
                <option class="mr-4" value="{{$city}}">
                   {{$city}}
              </option>
              @endif
          @endforeach
      </select>
    @endif
  </div>
