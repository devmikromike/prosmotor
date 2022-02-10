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
        <div class="flex flex-col bg-gray-200 dark:bg-gray-900 py-4 sm:pt-0 ">
          <div class="flex flex-row mt-4 mb-4">
            <div class="">
                @include('livewire.prospect.citydropdown')
            </div>
            <div class="">
                @include('livewire.prospect.businessfields')
            </div>
          </div>
            @foreach($newproslist['proslist'] as $key => $prospect)
                    @include ('livewire.prospect.table')
            @endforeach
      </div>
    </div>
    @endif
</div>
