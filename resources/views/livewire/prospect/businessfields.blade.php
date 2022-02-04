<div class="   ">

  <select class="mt-2 mb-4"  >
      @foreach($newcodelist as $code)
       <option class="mr-4" value="{{$code['code']}} ">
          {{$code['nameFI']}}
        @endforeach
  </select>
</div>
