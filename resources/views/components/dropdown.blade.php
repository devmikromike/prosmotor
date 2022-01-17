 
  <div class="bg-white rounded shadow-md py-2 " >
     {{ $slot }}
     <select class="mt-2" name="cityList[]" multiple>
       @foreach($cityList as $city)
         <option value="{{ $city->id }} " >
           {{ $city->name }}
         </option>
       @endforeach
     </select>
  </div>
