 @extends('parts.app')
    @section ('body')


          @auth
          <div class=" container mx-auto text-center flex flex-row mt-4   bg-gray-200">
            <div class="  border border-2 border-blue-300">
              @livewire('search.city',
              [

              ])
            </div>
          </div>

          @endauth
          <div class="container flex flex-row mx-auto bg-gray-200  ">
              <div class="mt-2  flex flex-1  ">
                @livewire('search-by-vatid',
                [
                    'placeholder' =>  __('messages.placeholder.vatid'),
                ])

              </div>
              <div class="mt-2  flex flex-1  ">
                 @livewire('search-by-name',
                 [
                  'placeholder' =>  __('messages.placeholder.name'),
                 ])
            </div>
         @auth
            <div class="mt-2  flex flex-1   ">
               @livewire('search-by-timeframe',
               [
                'placeholder' =>  __('messages.placeholder.start'),
                'placeholder2' =>  __('messages.placeholder.end'),
               ])
            </div>
          @endauth
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
