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
      <div class="mt-4 mb-4">
        <div class="flex flex-1 ">
            @foreach($newproslist as $prospects)
                @foreach($prospects as $prospect)
                  @include ('livewire.prospect.table')
              @endforeach
            @endforeach
      </div>
    </div>
    @endif
</div>
