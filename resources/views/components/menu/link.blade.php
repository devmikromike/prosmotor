@props(['route'])

@php
$clases = Request::routeIs($route) ? 'text-blue-500 underline' :  'hover:text-blue-500'
@endphp
  <div class="text-center bg-gray-100 mb-2">
    <a href="{{ route($route)}}"
    {{ $attributes->merge(['class' => "px-6 hover:underline"])}}  >
      <span class="ml-3">{{ $slot }}</span>
    </a>
  </div>
