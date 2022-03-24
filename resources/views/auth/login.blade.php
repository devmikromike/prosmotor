@extends('parts.app')
   @section ('body')

      @if ($errors->any())
        <div class="mx-auto my-4 bg-red-100 border border-red-400 rounded-lg shadow-lg sm:w-1/2">
           <div class="mx-2 text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

           <ul class="mx-4 mt-3 text-sm text-red-600 list-disc list-inside">
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
        </div>
        @endif
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
    <div class="mt-4 mx-auto my-4 rounded border border-blue-600 border-2 ">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mt-2">
                <label for="email" value="{{ __('auth.email') }}" />
                {{__('auth.email')}}
                <input id="email" class="block mt-1 w-full rounded" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <label for="password" value="{{ __('auth.password') }}" />
                {{__('auth.password')}}
                <input id="password" class="block mt-1 w-full rounded" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end border border-2 border-blue-500 mt-4">

                <button class="block mt-1 ml-4 rounded border border-blue-600 border-2 bg-blue-600">
                    {{ __('auth.submit') }}
                </button>
            </div>
        </form>
      </div>
 @endsection
