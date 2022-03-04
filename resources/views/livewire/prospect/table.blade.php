
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          @if(!empty($prospect))
            @foreach($prospect as $pros)
            {{--   dd($pros  );  --}}
              @if(!empty($pros))
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  ID / Vat Id (Y-tunnus)
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Yrityksen nimi
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      City (Kaupunki)
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- dd($pros['prospects'][0]); --}}
                      <div class="flex items-le">
                      ID:   @if(!empty($pros['id'])) {{ $pros['id'] }} /
                      {{ $pros['prospects'][0]['vatId']}}     @endif
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">
                        <a href="# ">
                              {{ $pros['prospects'][0]['name']}}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-le">
                        {{-- $pros['prospects'][0]->codeField($pros['id']) --}}
                      </div>
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                       @if(!empty($pros['city']))
                        {{  $pros['city']  }}
                       @endif
                      </span>
                      <a href="#" class="ml-2 text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                  </tr>
                  @endif
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
 </div>
</div>
