<button type="{{ $type ?? 'button' }}" {{ $attributes->merge(['class' => 'bg-[#eee] rounded-md py-1 px-2.5 m-1 border border-[#999] shadow-[0_1px_1px_0_rgba(187, 187, 187, 1)]']) }}>
  {{ $slot }}
</button>