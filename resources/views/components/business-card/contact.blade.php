<thead >
  <th class="text-center bg-blue-100 border text-left px-8 py-4">
    {{__('Titteli')}}
</th>
<th class="text-center bg-blue-100 border text-left px-8 py-4">
  {{__('Nimi')}}
</th>
<th class="text-center bg-blue-100 border text-left px-8 py-4">
  {{__('Sähköposti')}}
</th>
<th class="text-center bg-blue-100 border text-left px-8 py-4">
  {{__('Puhelin')}}
</th>
<th class="text-center bg-blue-100 border text-left px-8 py-4">
  {{__('Kännykkä')}}
</th>
</thead>
<div class="">
    <tr class="border text-left px-8 py-4 mr-4">
        @if(!empty($prospect))
            @foreach ($prospect['Contacts'] as $key => $contact)
                @if($key >0 && $prospect['Contacts'] == $prospect['Contacts']) @break @endif
              @if(!empty($contact))
                <td class="border text-left px-8 py-4 mr-4">
                  {{ $contact['title']}}
                </td>
                  <td class="border text-left px-8 py-4 mr-4">
                    {{ $contact['name']}}
                  </td>
                  <td class="border text-left px-8 py-4 mr-4">
                    @if(!empty($contact['email']))
                      {{ $contact['email']}}
                    @endif
                  </td>
                  <td class="border text-left px-8 py-4 mr-4">
                    {{ $contact['phone']}}
                  </td>
                  <td class="border text-left px-8 py-4 mr-4">
                    {{ $contact['mobile']}}
                  </td>
              @endif

            @endforeach
          @else
            <p class="border text-left"> {{__('businesscard.nocontact')}}</p>
       @endif
  </tr>
</div>
