@extends('parts.app')
@section('body')
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 ">
          <thead class="bg-gray-50 mb-4">
            <tr>
              <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                  font-medium text-gray-500 tracking-wider ">
                                                                              {{ $prospect->vatId}} </th>
              <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                  font-medium text-gray-500 tracking-wider">     {{ $prospect->name}}  </th>
              <th scope="col" class=" px-6 py-3 text-left text-md uppercase
                                  font-medium text-gray-500 tracking-wider">
                                  {{  url('') }} <br>
                                  {{  url()->full()}} <br>
                                  {{  $prospect->www }} 
             </th>

          </thead>

          <thead class="flex-row bg-gray-50">
            <tr>
              <th>
                {{__('Osoite')}}
              </th>
              <th>
                {{__('Postinumero')}}
              </th>
              <th>
                {{ __('Kaupunki')}}
              </th>
            </tr>
          </thead>
          <tbody class="bg-gray-50">
            <div class="border border-2 border-blue-700 ">
              @foreach ($location as $loc)
              <tr class="mb-4">
                <th>  {{ $loc->street}} </th>
                <th> {{ $loc->postCode }} </th>
                <th> {{ $loc->city }} </th>
              </tr>
              @endforeach
            </div>
        </tbody>
      </table>
      <table class="min-w-full divide-y divide-gray-200">
           <div class=" ">
             <thead class="bg-gray-50 mt-3">
               <tr class=" ">
                 <th>
                   {{__('Titteli')}}
                 </th>
                 <th>
                   {{__('Nimi')}}
                 </th>
                 <th>
                   {{__('Sähköposti')}}
                 </th>
                 <th>
                   {{__('Puhelin')}} / {{__('Kännykkä')}}
                 </th>

               </tr>
             </thead>
          <tbody>
             @foreach ($contacts as $contact)
             <tr>
               <th>
                 {{ !empty($contact['title'])}}
               </th>
               <th>
                 {{ $contact['name']}}
               </th>
               <th>
                 {{ $contact['email']}}
               </th>
               <th>
                 {{ $contact['phone'] }} / {{ $contact['mobile']}}
               </th>
             </tr>
             @endforeach
           </div>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
