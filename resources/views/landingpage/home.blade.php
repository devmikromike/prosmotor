<div class="container flex flex-row mx-auto ">
  <div class="  border border-2 border-blue-300">
    <x-slot name="city">
      @livewire('search.city',
      [

      ])
  </x-slot>
  <x-slot name="byVatId">
    @livewire('search-by-vatid',
    [
        'placeholder' =>  __('messages.placeholder.vatid'),
    ])
</x-slot>
  </div>
</div>
