<div class="py-1">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 bg-white border-b border-gray-200">
              <table class="min-w-full">
                @if(!empty($prospect))
                <thead class=" grid-rows-1 text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                  <tr class="grid row-auto grid-cols-3 text-left" >
                        <th   class="px-6 py-3  col-span-1 row-span-1">
                            {{__('prospectlist.vatid')}}
                        </th>
                        <th   class="px-6 py-3 col-span-1 row-span-1">
                            {{__('prospectlist.name')}}
                        </th>
                        <th   class="px-6 py-3  col-span-1 row-span-1" >
                              {{__('prospectlist.city')}}
                        </th>
                    </tr>
                </thead>
                    @foreach($prospect as $pros)
                      <tbody>
                        @if(!empty($pros))
                        <tr class="bg-white grid grid-cols-5 text-left border-b dark:bg-gray-800 dark:border-gray-700 border border-4">
                            <td class="px-6 py-4 text-left col-span-1">
                                ID:   @if(!empty($pros['id'])) {{ $pros['id'] }} /
                                {{ $pros['prospects'][0]['vatId']}}     @endif
                              </td>
                              <td class="px-6 py-4 text-left border border-4 col-span-2">
                                      {{ $pros['prospects'][0]['name']}}
                              </td>
                              <td class="flex justify-between px-3 py-4 text-left col-span-1">
                                @if(!empty($pros['city']))
                                 {{  $pros['city']  }}
                                @endif
                                <span class ="text-right">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </span>
                              </td>
                        </tr>
                        @endif
                    </tbody>
                    @endforeach
            @endif
          </table>
   </div>
  </div>
 </div>
</div>
