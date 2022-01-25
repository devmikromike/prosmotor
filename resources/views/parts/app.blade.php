<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('parts.head')
    </head>
    <body class="antialiased border border-2 border-blue-300 mr-2 ml-2 mt-3 mb-3">
        <div class="flex flex-col bg-gray-200 dark:bg-gray-900 py-4 sm:pt-0">
          @include('parts.header')
          @yield('body')

    <livewire:scripts/>
    </body>
@include('parts.footer')
