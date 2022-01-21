@extends('parts.app')
@section('body')

  @foreach ($bsscodes as $code)   
  {{ $code['code'] }}
  {{ $code['nameFI'] }}
  @endforeach

@include('prospect.table')
@endsection
