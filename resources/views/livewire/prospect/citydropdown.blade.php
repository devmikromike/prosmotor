  <div class=" ">
    @if(!empty($newcitylist))
       <select class="mt-2 mb-4">
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
