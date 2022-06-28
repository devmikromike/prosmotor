
<div class="ml-4  bg-gray-200">
  <div class="mb-4 flex flex-3/4 ">

    @if(!empty($citynames))
       <select class="mt-2 mb-4" value =" "  >
           <option class="mr-4" value="" selected>{{__('Kaikki Kaupungit')}} </option>
          @foreach($citynames as $city)
              @if(!empty($city))
                <option class="mr-4" value="{{$city->name}}">
                   {{$city->name}}
              </option>
              @endif
          @endforeach
      </select>
    @endif
  </div>
  <div class="flex flex-1/2">
      {{ $citynames->links() }}
  </div>
</div>
