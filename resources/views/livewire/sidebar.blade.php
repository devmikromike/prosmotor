<div class="overflow-y-auto rounded-lg shadow-lg dark:bg-gray-800">

  <ul>
    @guest
    <li  class="px-4 py-4 text-purple-100 bg-purple-500">
      <a href="/auth/login">{{__('auth.submit')}}</a>
    </li>
    <hr>

    @endguest
      <p class="px-4 py-4">{{__('search.title')}}</p>
    <li>
      <button wire:click="openByVatid" class="px-4 py-2 text-purple-100 bg-purple-500">
         <p>{{__('search.vatid')}}</p>
      </button>
    </li>
    @if ($showVatid)
        <div>
            @livewire('search-by-vatid',
            [
                'placeholder' =>  __('messages.placeholder.vatid'),
            ])
        </div>
    @endif
    <li>
      <button wire:click="openByName"  class="px-4 py-2 text-purple-100 bg-purple-500">
          <p>{{__('search.name')}}</p>
      </button>
    </li>
    @if ($showName)
        <div>
            @livewire('search-by-name',
            [
                'placeholder' =>  __('messages.placeholder.name'),
            ])
        </div>
    @endif
  </ul>

@auth
  <ul>
    <li>
      <button wire:click="openByTimeFrame"  class="px-4 py-2 text-purple-100 bg-purple-500">
          <p>{{__('search.timeFrame')}}</p>
      </button>
    </li>
    <li>
    @if ($showTimeFrame)
      <div class="">
        @livewire('search-by-timeframe',
        [
         'placeholder' =>  __('messages.placeholder.start'),
         'placeholder2' =>  __('messages.placeholder.end'),
        ])
        </div>
      @endif
  </li>
  <li>
    <button wire:click="openByCity"  class="px-4 py-2 text-purple-100 bg-purple-500">
        <p>{{__('search.city')}}</p>
    </button>
  </li>
  <li>
    @if ($showCity)
      <div class="">
        @livewire('city-dropdown')
      </div>
    @endif
  </li>
  </ul>
@endauth
</div>
