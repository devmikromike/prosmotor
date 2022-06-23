<div class="flex flex-row ml-4">
    <div class ="ml-4 mr-2 " x-data="{ open: false }">
        <button @click="open = !open"> Main</button>
        <div x-show="open" class="">

          @livewire('business-card.main',
          [
          ])
        </div>
    </div>

    <div class ="ml-4 mr-2 " x-data="{ show: false }">
        <button @click="show = !show">Contact</button>
        <div x-show="show" class="">
          @livewire('business-card.contact',
             [])
        </div>

    </div>
</div>
