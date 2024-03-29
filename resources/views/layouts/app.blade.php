<!DOCTYPE html>
<html lang="{{App::getLocale() }}">
    <head>
        @include('parts.head')
        @if(!session()->has('applocale'))
          {{session()->put('applocale', 'en')}}
       @endif
    </head>
    <body class="antialiased border border-2 border-blue-300 mr-2 ml-2 mt-3 mb-3">
        <div class="flex flex-col bg-gray-200 dark:bg-gray-900 py-4 sm:pt-0">
          @include('parts.header')
          @yield('content')
    <livewire:scripts/>
    </body>
@include('parts.footer')
