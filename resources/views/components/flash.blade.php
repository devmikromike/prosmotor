@props([
  'type' =>'success',
  'colors' => [
    'success' => 'bg-green-400 border-green-600',
    'error' => 'bg-red-400 border-red-600',
    'warning' => 'bg-orange-400 border-orange-600'
  ]
])
<section {{ $attributes->merge(['class' => "{colors[$type]} border-b p-4"]) }} ">
  <div class="flex justify-between">
    <p>
        {{ $slot }}
    </p>
    <button >&times;</button>
  </div>
</section>
