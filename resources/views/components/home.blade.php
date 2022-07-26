@props([
'nameLink' => ''
])
<div class="container flex flex-row mx-auto ">
  <div class="  border border-2 border-blue-300">
    {{ $slot }}
  </div>
</div>
