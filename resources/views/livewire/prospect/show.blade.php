<div class="flex">
  <div class="flex flex-col ">
    <div class=" overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 ">
            @foreach($prospect as $p)
            <thead class="bg-gray-50 mb-4">
                {{--   dd($pros );  --}}
              <tr>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
              {{__('Yritys ID: ')}}  {{  $pros->id}} {{'  /  '}}   {{__('Y-tunnus: ')}}{{ $p['businessId'] }}
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
                  {{ $p['name'] }} {{'  /  '}}  {{  $pros->www}}
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
                  {{ $pros->bssCode}}  {{'  /  '}}    {{-- dd($pros->bssCodeField->nameFI); --}}              
                </th>
             </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">

                </th>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
     </div>
   </div>
  </div>
</div>
