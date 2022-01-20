@extends('parts.app')
@section('body')
  @foreach($proslist as $reponse)
    @foreach($reponse  as $pros)    
   <ul>
      <li>
          {{ $pros['vat_id'] }}
      </li>
      <li>
        {{ $pros['name'] }}
      </li>
      <li>
        {{ $pros['city'] }}
      </li>
    </ul>
    @endforeach
  @endforeach
@endsection
