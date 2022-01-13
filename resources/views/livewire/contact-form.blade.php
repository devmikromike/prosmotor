<div>
  <form wire:submit.prevent="submitForm" class="grid grid-cols-1 row-gap-6" action="{{route('contactform')}}" method="post">
    @csrf
    <div class="">
      {{session('success_message')}}
    </div>
    <div class="">
      <label for="name" class="sr-only">Full name</label>
    </div>
    <div class="relative rounded-md shadow-sm">
      <input wire:model.defer="name" id=" name" type="text" name="name"
      value="{{ old ('name')}}"
      class="@error('name')
      border-red-500 @enderror
      form-imput block w-full py-3 px-3
      placeholder-gray-500 transition
      ease-in-out duration-150"
      placeholder= "Full Name">
    </div>
    @error('name')
    <p class="text-red-500 -mt-1">{{ $message }}</p>
    @enderror


    <div class="">
        <span class="inline-flex rounded-md shadow-sm">
            <button type="submit"
                class="inline-flex items-center justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                <svg wire:loading wire:target="submitForm" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span>Submit</span>
            </button>
        </span>
    </div>>
  </form>


</div>
