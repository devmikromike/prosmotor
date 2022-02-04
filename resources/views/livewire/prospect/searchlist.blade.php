<div>
    <div wire:loading>
            {{__('Hetki vielä ...')}}
    </div>
    @if(session()->has('message'))
    <div class="flex flex-1 ml-3 mt-2 mb-4 bg-blue-300">
      {{ session('message') }}
    </div>
    @endif
    @if(!empty($newproslist))
  {{--    <div class="mt-4 mb-4"> --}}
  {{--      <select class="mt-2 mb-4" name="codelist"> --}}
  {{--          @foreach ($bsscodes as $code) --}}
  {{--              <option class="mr-4" value="{{ $code['code'] }} "> --}}
  {{--                  {{ $code['code']  }} ..... {{ $code['nameFI'] }} --}}
  {{--              </option>
  {{--         @endforeach --}}
    {{--    </select> --}}
        <div class="flex flex-col bg-gray-200 dark:bg-gray-900 py-4 sm:pt-0 ">
            @foreach($newproslist as $prospects)
                @foreach($prospects as $prospect)
                  @include ('livewire.prospect.table')
              @endforeach
            @endforeach
      </div>
    </div>
    @endif
</div>
