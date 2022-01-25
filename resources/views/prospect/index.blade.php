@extends('parts.app')
@section('body')
<select class="mt-2 mb-4" name="codelist">
  @foreach ($bsscodes as $code)
      @foreach ($totalcount as $count)
          @if ($count['code'] === $code['code'])
            <option value="{{ $code['nameFI'] }} ">
            {{ $code['code'] }} ..... {{ $code['nameFI'] }} ... {{__('Kokonaismäärä')}}
            {{ $count['total'] }}
      @else
          @continue
      @endif
    </option>
    @endforeach
 @endforeach
</select>
@include('prospect.table')
@endsection
