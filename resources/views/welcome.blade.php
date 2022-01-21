 @extends('parts.app')
    @section ('body')
          <div class="flex flex-col mt-4">
              <span class="container text-center font-semibold text-xl bg-gray-300 mx-auto mb-2 " >
                 Search companies from local database, if it is not exist, it will automatic find from PRH.
                 <p>You can search only Limited companies (OY).</p>
               </span>
          </div>
          <div class="container flex flex-row mx-auto bg-gray-200  ">
              <div class="mt-2  flex flex-1  ">
                   @livewire('search-by-vatid',
                   [
                    'placeholder' => 'Search By Vat Id',
                   ])
              </div>
              <div class="mt-2  flex flex-1  ">
                 @livewire('search-by-name',
                 [
                  'placeholder' => 'Search By name or partial name.',
                 ])
            </div>
            <div class="mt-2  flex flex-1   ">
               @livewire('search-by-timeframe',
               [
                'placeholder' => 'Give start date..',
                'placeholder2' => 'Give end date..'
               ])
            </div>
          </div>
            <div class="container mt-4 flex flex-col mx-auto bg-gray-200  ">
              <div class="flex mt-4 flex-1 mb-2">
                  <span class="container  text-center font-semibold text-xl bg-gray-300 mx-auto  " >
                    Search companies from local database by using filters.</span>
              </div>
              <div class="flex flex-1 ">
                 <div class="flex flex-col flex-1  bg-blue-300 ">
                   <form class=" flex " action="{{ route('public.index') }} " method="post">
                         @csrf

                     <div class="flex flex-row ml-4 mt-4">
                       <div class=" flex flex-1 flex-col ml-6 bg-blue-300">
                         <p class="mb-2">Pickup City(es) from CityList, Max 5.</p>
                         <select class="mt-2" name="cityList[]" multiple>
                           @foreach($cityList as $city)
                             <option value="{{ $city['name'] }} " >
                               {{ $city['name'] }}
                             </option>
                           @endforeach
                         </select>
                       </div>
                       <div class=" flex flex-col ml-6 mr-4 flex-1 ">
                         <p class="mb-2"  >Pickup Code(es) from CodeList, Max 1.</p>
                         <select class="mt-2" name="idsList[]" multiple>
                           @foreach($codeList as $code)
                             <option value="{{ $code['id'] }} " >
                               {{ $code['nameFI'] }}
                             </option>
                           @endforeach
                         </select>
                       </div>
                     </div>
                     <button type="submit" name="button">Send query</button>
                   </form>
                 </div>
              </div>
            </div>
        </div>
@endsection
