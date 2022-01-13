<div>
  <div class="">
    <label wire:dirty.class="border-red-500" wire:target="{{ $name }}" for="{{ $name }}" class="sr-only">{{ $name }}</label>
  </div>
  <div class="relative rounded-md shadow-sm">
    <input wire:model.defer="vatID" id=" {{ $name }}" type="text" name="{{ $name }}"
    class="@error('{{ $name }}')
    border-red-500 @enderror
    form-imput block w-full py-3 px-3
    placeholder-gray-500 transition
    ease-in-out duration-150"
    placeholder= " {{ $placeholder }}"
    >
  </div>
  <br>  {{ $name }}
</div>
