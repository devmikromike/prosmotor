@props([
  'data'
])
<div class="mt-2 mb-4 mr-4 bg-blue-300 rounded shadow-md">
  <table class="shadow-lg bg-white">
    <thead >
      <th class="text-center bg-blue-100 border text-left px-8 py-4">
        Y-tunnus
      </th>
      <th class="text-center bg-blue-100 border text-left px-8 py-4">
       Yritys
      </th>
      <th class="text-center bg-blue-100 border text-left px-8 py-4">
       Kotisivut
      </th>
        <th class="text-center bg-blue-100 border text-left px-8 py-4">
          Rekisteröinti päivä
        </th>
        <th class="text-center bg-blue-100 border text-left px-8 py-4">
          Status
        </th>
    </thead>

    @foreach($data['data'] as $prospect)
        <tr>
          <td class="border text-left px-8 py-4 mr-4">
            {{ $prospect['vatId'] }}
          </td>
          <td class="border text-left px-8 py-4 mr-4">
            {{ $prospect['name'] }}
          </td>
          <td class="border text-left px-8 py-4 mr-4">
            {{ $prospect['www'] }}
          </td>
          <td class="border text-left px-8 py-4 mr-4">
            {{ $prospect['registrationDate'] }}
          </td>
          <td>
            {{ $prospect['prospect_status'] }}
          </td>
        </tr>
          <x-business-card.contact :prospect="$prospect"/>
           <x-business-card.location :prospect="$prospect"/> 
    @endforeach

  </table>
</div>
