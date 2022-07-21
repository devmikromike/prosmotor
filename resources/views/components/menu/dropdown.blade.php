<div class="relative" x-data="{ open: false }" @click.away="open = false" >
  <div @click="open = !open" class="bg-gray-100 mb-2" >
    {{ $trigger }}
  </div>
  <div class="absolute z-20 bg-white rounded-md shadow-md py-2 mt-2" x-show="open">
    {{ $slot }}
  </div>
</div>
