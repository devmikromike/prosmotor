<div class="relative bg-white mt-8">
        <div class="bg-white py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
            <div class="max-w-lg mx-auto lg:max-w-none">
                <form wire:submit.prevent="submitForm" action="/contact" method="POST" class="grid grid-cols-1 row-gap-6">
                    @csrf

                    @if ($successMessage)
                    <div class="rounded-md bg-green-50 p-4 mt-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm leading-5 font-medium text-green-800">
                                    {{ $successMessage }}
                                </p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button
                                        type="button"
                                        wire:click="$set('successMessage', null)"
                                        class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150"
                                        aria-label="Dismiss">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label for="name" class="sr-only">Full name</label>
                        <div class="relative rounded-md shadow-sm border border-2 border-blue-300">
                            <input wire:model="name" id="name" name="name" value="{{ old('name') }}"
                                class="@error('name')border border-red-500 @enderror form-input block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                placeholder="Full name">
                        </div>
                        @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div>
                        <label for="message" class="sr-only">Message</label>
                        <div class="relative rounded-md shadow-sm">
                            <textarea wire:model="message" id="message" rows="4" name="message"
                                class="@error('message')border border-red-500 @enderror form-input block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                placeholder="Message">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <span class="inline-flex rounded-md shadow-sm ">
                            <button type="submit"
                                class="inline-flex items-center
                                justify-center py-3 px-6 border
                                border-transparent text-base leading-6
                                font-medium rounded-md text-blue-400
                                bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                                <svg wire:loading wire:target="submitForm"
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span>Submit</span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
