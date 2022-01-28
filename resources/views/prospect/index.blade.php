@extends('parts.app')
@section('body')
  <select class="mt-2 mb-4" name="codelist">
      @foreach ($bsscodes as $code)

          <option class="mr-4" value="{{ $code['nameFI'] }} ">
              {{ $code['code'] }} ..... {{ $code['nameFI'] }}
          </option>
     @endforeach
  </select>
  @include('prospect.table')
@endsection
