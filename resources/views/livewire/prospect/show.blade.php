<div class="flex">
  <div class="flex flex-col ">
    <div class=" overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          {{-- dd($prosmodel); --}}
          @if(!empty($prosmodel))
          <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50 mb-4">
              <tr>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
             @if(!empty($prosmodel->vatId)){{__('Y-tunnus: ')}} {{ $prosmodel->vatId }} @endif
                </th>
                <th scope="col" class=" shadow px-6 py-3 text-left text-md uppercase
                                        font-medium text-gray-500 tracking-wider
                                        border border-blue-800 border-4 ">
            @if(!empty($prosmodel->name))
                <a href="businesscard/{{$prosmodel->id}}" class="hover:shadow hover:text-gray-900"> 
                {{$prosmodel->name}}</a>
            @endif
            @if(!empty($prosmodel->www)) {{('  /  ')}}
            <a href="http://{{$prosmodel->www}} " class="hover:shadow hover:text-gray-900"
               target="_blank"> {{$prosmodel->www}} </a>
             @endif
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
            @if(!empty($prosmodel->bsscode)) {{ $prosmodel->bsscode }}{{(' / ')}} {{$prosmodel->nameFI}} @endif
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">

                </th>
             </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
                  @if(!empty($prosmodel->street)) {{ $prosmodel->street }}{{('  /  ')}} {{$prosmodel->postCode}} @endif
                </th>
                <th>
                  @if(!empty($prosmodel->city)) {{ $prosmodel->city }} @endif
                </th>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
     </div>
   </div>
  </div>
</div>
