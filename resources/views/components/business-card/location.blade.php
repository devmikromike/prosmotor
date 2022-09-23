<div>
   @if(!empty($prospect['Locations']))
    @foreach ($prospect['Locations'] as $key => $location)
        @if($key > 1 ) @break @endif
      <thead>
        <th class=" bg-blue-100 border text-left px-8 py-4">
           @if($key == 1 && $location['type'] ==  1 )
               {{__('Käyntiosoite')}}
        </th>
                 <th class=" bg-blue-100 border text-left px-8 py-4">
                   {{__('C/O')}}
                </th>
                <th class=" bg-blue-100 border text-left px-8 py-4">
                 {{__('Postinumero')}}
                </th>
                <th class=" bg-blue-100 border text-left px-8 py-4">
                 {{__('Kaupunki')}}
                </th>

          @endif
        @if($key == 0 && $location['type'] == 2 )

         {{__('Postiosoite')}}

          </th>
          <th class=" bg-blue-100 border text-left px-8 py-4">
            {{__('C/O')}}
        </th>
        <th class=" bg-blue-100 border text-left px-8 py-4">
          {{__('Postinumero')}}
        </th>
        <th class=" bg-blue-100 border text-left px-8 py-4">
          {{__('Kaupunki')}}
        </th>

       @endif

   </thead>

   <div class="">
       <tr class="border text-left px-8 py-4 mr-4">
             @if(!empty($location))
                   <td class="border text-left px-8 py-4 mr-4">
                     {{ $location['street']}}
                   </td>
                     <td class="border text-left px-8 py-4 mr-4">
                       {{ $location['careOf']}}
                     </td>

                       <td class="border text-left px-8 py-4 mr-4">
                           {{ $location['postCode']}}
                       </td>
                       <td class="border text-left px-8 py-4 mr-4">
                         {{ $location['city']}}
                       </td>
                       <td class="border text-left px-8 py-4 mr-4">
                         {{ $location['country']}}
                       </td>
               @endif
     </tr>

       @endforeach
       @else
         <p class="border text-left"> {{__('businesscard.nocontact')}}</p>
    @endif
   </div>

</div>
