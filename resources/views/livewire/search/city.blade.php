
<div class="flex-col ml-4  bg-gray-200">
  <div class="mb-4 flex flex-3/4 ">

    @if(!empty($citynames))

       <select class="mt-2 mb-4" value =" "  >
           <option class="mr-4" value="" selected>  </option>
          @foreach($citynames as $city)

              @if(!empty($city))
                <option class="mr-4" value="{{ $city->id }}  ">
                  {{ $city->name }}
              </option>
              @endif
          @endforeach
      </select>

  </div>
      <div class="  mb-4 mr-2 flex flex-2/4 ">
          {{ $citynames->links() }}
      </div>

    @endif
</div>
