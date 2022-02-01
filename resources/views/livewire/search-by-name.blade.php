<div>
  <form action="#" wire:submit.prevent="submit">
      @csrf
      <div>
        <div class="">
          <label  for="name" class="sr-only">Name</label>
        </div>
        <div class="relative rounded-md shadow-sm">
          <input wire:model.lazy ="name" id="name" type="text" name="name"
          class="@error('name')
          border-red-500 @enderror
          form-imput block w-full py-3 px-3
          placeholder-gray-500 transition
          ease-in-out duration-150"
          placeholder= " {{ $placeholder }}"
          >
          {{ $name }}
        </div>
          <button class="mt-4 p-2 bg-blue-300 border rounded border-1 border-gray-600">{{__('Hae PRHsta')}}</button>
      </div>

  </form>
 <div class="">

   {{ $statusMessage }}


 </div>
</div>
