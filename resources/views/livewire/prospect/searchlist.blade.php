<div>
    <div wire:loading>
            {{__('Hetki vielä ...')}}
    </div>
    @if(session()->has('message'))
    <div class="flex flex-1 ml-3 mt-2 mb-4 bg-blue-300">
      {{ session('message') }}
    </div>
    @endif
      @if($proslists['proslist'])
          <table>
            <thead>
              <tr>
                <th class="  bg-blue-200 border text-left px-8 py-4">
                  ID / VatId:
                </th>
                <th class="  bg-blue-200 border text-left px-8 py-4">
                  Name / www:
                </th>
                <th class="  bg-blue-200 border text-left px-8 py-4">
                  Street / Postcode / City
                </th>
              </tr>
            </thead>
            <tbody>
            @foreach ($proslists['proslist'] as $prospects)
              @foreach($prospects as $pros)
                <tr>
                  <td class="  bg-blue-100 border text-left px-8 py-4">
                    {{ $pros['prospects'][0]['id'] }} {{ ' / '}} {{ $pros['prospects'][0]['vatId'] }}
                  </td>
                  <td class="  bg-blue-100 border text-left px-8 py-4">
                    {{ $pros['prospects'][0]['name'] }}
                     @if($pros['prospects'][0]['www']) {{ ' / '}}{{ $pros['prospects'][0]['www'] }} @endif
                  </td>
                  <td class="  bg-blue-100 border text-left px-8 py-4">
                    {{ $pros['street']  }} {{ ' / '}} {{ $pros['postCode']  }}
                    {{ ' / '}} {{ $pros['city']  }}

                  </td>
                </tr>
              @endforeach
          @endforeach
        </tbody>
      </table>
      @else
      <p> {{__('No company found, business field which you have chosen!')}} </p>
    @endif
</div>
