<div class="flex">
  <div class="flex flex-col ">
    <div class=" overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50 mb-4">
              {{--  dd($prosmodel);  --}}

              <tr>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
              {{__('Yritys ID: ')}} @if(!empty($prosmodel->vatId))  {{ $prosmodel->vatId }} @endif
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                    font-medium text-gray-500 tracking-wider ">
            @if(!empty($prosmodel->name)) {{$prosmodel->name}} @endif
            @if(!empty($prosmodel->www)) {{(' / ')}} {{$prosmodel->www}} @endif
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
        </div>
     </div>
   </div>
  </div>
</div>
