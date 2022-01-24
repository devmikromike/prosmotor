@extends('parts.app')
@section('body')

  @foreach ($totalcount as $count)

  @endforeach
<select class="mt-2 mb-4" name="codelist">

  @foreach ($bsscodes as $code)
    <option value="{{ $code['nameFI'] }} " >
      {{ $code['code'] }} ..... {{ $code['nameFI'] }}
      @if {{ $count['code'] === $code['code']  }}
      @endif
    </option>
     @endforeach
</select>
@include('prospect.table')
@endsection
