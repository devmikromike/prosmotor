<div>
   <div class="">
     @if (session()->has('message'))
           <div class="">
                  {{ session('message') }}
           </div>
     @endif
   </div>


@if(!empty($prospect))

  @foreach($prospect as $msg)
  @dd($msg)
  <table>
    <thead>
      <th>
       Y-tunnus
      </th>
      <th></th>
      <th>
       Kotisivut
      </th>
    </thead>

    <tbody>
      <tr>

        <td>
          {{ $msg['vatId'] }}
        </td>
        <td>
          {{ $msg['name'] }}
        </td>
        <td>
          {{ $msg['www'] }}
        </td>
        <td>
          {{ $msg['registrationDate'] }}
        </td>
      </tr>
    </tbody>
  </table>

  @endforeach
  @else
    <p> Here will be data</p>
@endif

</div>
