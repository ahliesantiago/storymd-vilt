<x-layout :title="'Browse | StoryMD'">
  <div class="px-10 py-8">
    {{-- <h2 class="text-4xl font-serif">1-{{ $works->count() > 20 ? 20 : $works->count() }} of {{ $works->count() }} Works in <a href="/" class="underline decoration-dotted">Series1</a></h2> --}}
    <h2 class="text-4xl font-serif">Recent Works</h2>
    <div class="text-center">
      <button><a href="#">← Previous</a></button>
      <button>1</button>
      <button>2</button>
      <button>3</button>
      <button><a href="#">Next →</a></button>
    </div>
    @unless(count($works) == 0)
      @foreach($works as $work)
        @if($work->chapters->first()['is_published'] && $work['is_private'] == 0)
          <x-work-card :work="$work" />
        @endif
      @endforeach
  
    @else
      <p>No works found...</p>
  
    @endunless
  </div>
</x-layout>