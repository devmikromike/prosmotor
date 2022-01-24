@extends('parts.app')
@section('body')

<select class="mt-2 mb-4" name="codelist">

  @foreach ($bsscodes as $code)
    @foreach ($totalcount as $count)
    <option value="{{ $code['nameFI'] }} ">
      {{ $code['code'] }} ..... {{ $code['nameFI'] }} ... Total 
      {{ $count['code'] === $code['code'] ?  $count['total']  : @continue  }}
    </option>
    @endforeach
  @endforeach
</select>
@include('prospect.table')
@endsection
