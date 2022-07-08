
<div class="flex-col ml-4  bg-gray-200">

  <div class="mb-4 flex flex-3/4 ">
    @if(!empty($citynames))

       <select class="mt-2 mb-4"  wire:model="selectedCity">
           <option class="mr-4" value="" selected>  </option>
          @foreach($citynames as $city)
              @if(!empty($city))
                <option class="mr-4" value="{{$city->id}}">
                  {{ $city->name }}
              </option>
              @endif
          @endforeach
      </select>
  </div>

    @endif

    <div class="">
      @if (!is_null($selectedCity))
      <div class="">
        <select class="mt-2 mb-4"  wire:model="SelectedPostalCode">
          <option class="mr-4" value="" selected>  </option>
            @foreach($postalCodes as $code)
              @if (!is_null($code))
                <option class="mr-4" value="{{ $code->postalCode }} ">
                  {{ $code->postalCode }}
              </option>
              @endif
            @endforeach
          </select>
      </div>
      @endif
    </div>
    <div class="">
      @if (!is_null($SelectedPostalCode))
        <div class="">
          @if(!is_null($bssCodes))
            <select class="mt-2 mb-4"  wire:model="SelectedBssCode">
              <option class="mr-4" value="" selected>  </option>
                @foreach($bssCodes as $bssCode)
                    @if (!is_null($bssCode))
                      <option class="mr-4" value="{{ $bssCode->code }} ">
                        {{ $bssCode->nameFI }}
                    </option>
                  @endif
                @endforeach
              </select>
         @endif
        </div>
      @endif
        @if (!is_null($SelectedBssCode))
        <button type="button" name="button">Send search</button>
        @endif
    </div>
</div>
