<div>
  <form action="#" wire:submit.prevent="submit">
      @csrf
      <div>
        <div class="">
          <label  for="from" class="sr-only">From</label>
        </div>
        <div class="relative rounded-md shadow-sm">
          <input wire:model.lazy ="from" id="from" type="text" name="from"
          class="@error('from')
          border-red-500 @enderror
          form-imput block w-full py-3 px-3
          placeholder-gray-500 transition
          ease-in-out duration-150"
          placeholder= " {{ $placeholder }}"
          >
          {{ $from }}
        </div>
        <div class="">
          <label  for="to" class="sr-only">Name</label>
        </div>
        <div class="relative rounded-md shadow-sm">
          <input wire:model.lazy ="to" id="to" type="text" name="to"
          class="@error('to')
          border-red-500 @enderror
          form-imput block w-full py-3 px-3
          placeholder-gray-500 transition
          ease-in-out duration-150"
          placeholder= " {{ $placeholder }}"
          >
          {{ $to}}
        </div>
          <button class="mt-4 p-2 bg-blue-300 border rounded border-1 border-gray-600">Send Query</button>
      </div>
       Current time: {{ now() }}
  </form>
 <div class="">

   {{ $statusMessage }}


 </div>
</div>
