@props([ 'url' ])

<a href="{{ $url }}" {{ $attributes->merge(['class' => 'underline decoration-dotted']) }}>
  {{ $slot }}
</a>