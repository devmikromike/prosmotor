@extends('parts.app')
@section('body')
  @foreach($proslist  as $pros)
  {{ dd($pros);}}
  <ul>
    <li>
        {{ $pros['vat_id'] }}
    </li>
    <li>
      {{ !empty($pros['name']) }}
    </li>
    <li>
      {{ $pros['city'] }}
    </li>
  </ul>
  @endforeach
@endsection
