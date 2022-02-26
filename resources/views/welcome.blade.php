 @extends('parts.app')
    @section ('body')
          <div class="flex flex-col mt-4">
            <div class="flex text-black ml-4 mr-4">
              @if(!session()->has('applocale'))
                {{session()->put('applocale', 'fi')}}
              @endif
              @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())

                {{  Config::get('languages')[App::getLocale()]['message']}}
               <div class="mr-4 ml-4  ">
                    <a class="flex" href="{{ route('lang.switch', $lang) }}">
                  {{ Config::get('languages')[App::getLocale()]['display'] }}
                    <div class="mb-1">
                    <img src="{{ asset('icon/'.Config::get('languages')[App::getLocale()]['flag-icon'].'.' .'svg') }}"
                           width="10" height="10"/>
                   </div>
                   </a>
              </div>
               @endif
            @endforeach
          </div>
              <span class="container text-center font-semibold text-xl bg-gray-300 mx-auto mb-3 " >
                {{__('messages.header')}} <br>
                {{__('messages.headerline2')}}<br>
                 <p class="mt-2">{{__('messages.subheader')}}</p>
               </span>
          </div>
          <div class="container flex flex-row mx-auto bg-gray-200  ">
              <div class="mt-2  flex flex-1  ">
                   @livewire('search-by-vatid',
                   [
                    'placeholder' => 'Hae Y-tunnuksella.',
                   ])
              </div>
              <div class="mt-2  flex flex-1  ">
                 @livewire('search-by-name',
                 [
                  'placeholder' => 'Nimellä tai osa-nimellä.',
                 ])
            </div>
            <div class="mt-2  flex flex-1   ">
               @livewire('search-by-timeframe',
               [
                'placeholder' => 'Aloituspäivä..',
                'placeholder2' => 'Päättymispäivä..'
               ])
            </div>
          </div>
          <div class="container mt-4 flex flex-col mx-auto bg-gray-200 ">
            <div class="flex mt-4 flex-1 mb-2 ml-2 ">
              @livewire('prospect.show')
            </div>
          </div>

            <div class="container mt-4 flex flex-col mx-auto bg-gray-200  ">
              <div class="flex mt-4 flex-1 mb-2">
                  <span class="container  text-center font-semibold text-xl bg-gray-300 mx-auto  " >
                    {{__('messages.title')}}</span>
              </div>
              <div class="">
                @livewire('prospect.index')
              </div>
                @livewire('prospect.searchlist')
            </div>
        </div>
@endsection
