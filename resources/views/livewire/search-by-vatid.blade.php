<div>
  <form action="#" wire:submit.prevent="submit">
      @csrf
      <div>
        <div class="">
          <label  for="vatId" class="sr-only">vatID</label>
        </div>
        <div class="relative rounded-md shadow-sm">
          <input wire:model.lazy ="vatId" id="vatid" type="text" name="vatId"
          class="@error('vatId')
          border-red-500 @enderror
          form-imput block w-full py-3 px-3
          placeholder-gray-500 transition
          ease-in-out duration-150"
          placeholder= " {{ $placeholder }}">
          {{ $vatId }}
        </div>
          <button class="mt-4 p-2 bg-blue-300 border rounded border-1 border-gray-600">{{__('messages.searchbutton')}}</button>
      </div>

  </form>
  <br>
  <div class="">
    {{ $statusMessage }}
  </div>
   <br>
</div>
