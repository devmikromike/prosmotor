<div class="flex">
      <div class="flex flex-col ">
        <div class=" overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle     sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

              @if(!empty($prosmodel))

              <table class=" divide-y divide-gray-200 flex-1">
                  <thead class="bg-gray-50 mb-4">
                    <tr>
                      <th scope="col" class=" px-6 py-3 text-left text-md
                                          font-medium text-gray-500 tracking-wider ">
                      <p class="mb-3">
                        {{$prosmodel['name']}}
                      </p>
                      <p>
                        <h3> Status: </h3>{{$prosmodel['process_status']}}
                      </p>

                    </th>
                    <th scope="col" class=" px-3 py-3 text-left text-md
                                        font-medium text-gray-500 tracking-wider ">

                <p>{{ __('prospectlist.vatid')}} {{$prosmodel['vatId']}} </p>
                  </th>
                  <th scope="col" class=" px-3 py-3 text-left text-md
                                      font-medium text-gray-500 tracking-wider ">
                                      <p>{{ __('prospectlist.registerDate')}} </p>
                  <p>{{$prosmodel['registrationDate']}}</p>
                </th>
                <th scope="col" class=" px-6 py-3 text-left text-md
                                    font-medium text-gray-500 tracking-wider ">
                                    <p>{{$prosmodel['bsscode']}}</p>
                <p>{{$prosmodel['nameFI']}}</p>
              </th>
            </tr>
          </thead>
              <tbody  class="flex flex-1 px-2 py-3 bg-gray-300">
                <tr class="   px-6 py-3 text-left text-md
                                    font-medium text-gray-500 tracking-wider ">
                <td   class="flex flex-1 ">
                  <div class="  ">
                    <div class="f  ">
                      <p>{{ __('prospectlist.visit')}}:
                         &nbsp;&nbsp;</p>
                      <form class=" flex flex-1 justify-between tracking-wider " action="index.html" method="post">
                        <input type="text" name="" value="{{$prosmodel['street']}}">
                        <input type="text" name="" value="{{$prosmodel['postCode']}}">
                        <input type="text" name="" value="{{$prosmodel['city']}}">
                        <span class="px-2 py-2 ">
                          <p> Huhuu</p>
                        </span>
                      </form>


                    </div>

                  </div>
                  </td>
                </tr>


              </tbody>
            </table>
           @endif
             </div>
           </div>
         </div>
       </div>
</div>
