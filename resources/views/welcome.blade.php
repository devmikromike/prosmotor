 @extends('parts.app')
    @section ('body')
          <div class="flex flex-col mt-4">
              <span class="container text-center font-semibold text-xl bg-gray-300 mx-auto mb-3 " >
                {{ __(" Voit hakea yrityksiä , PRH:n - (Patentti- ja rekisterihallitus) rekisteristä.") }} <br>
                {{ __(" yrtistiedot tallentuvat automaattisesti ProspectMoottoriin.") }}<br>
                 <p class="mt-2">{{__("Tällä hetkellä voit hakea ainostaan Osakeyhtiöiden tietoja (OY).")}}</p>
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
            <div class="container mt-4 flex flex-col mx-auto bg-gray-200  ">
              <div class="flex mt-4 flex-1 mb-2">
                  <span class="container  text-center font-semibold text-xl bg-gray-300 mx-auto  " >
                  {{ __('Voit hakea yrityksiä paikalliseta tietopankista, käyttämällä filtereitä.')}}</span>
              </div>
              <div class="">
                @livewire('prospect.index')
              </div>
            </div>
        </div>
@endsection
