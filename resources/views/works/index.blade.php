<x-layout :title="'Browse | StoryMD'">
  <div class="px-10 py-8">
    @unless(count($works) == 0)
      @if ($type == 'browse')
        <h2 class="text-4xl font-serif">Recent Works</h2>
        <p>These are some of the latest works posted to the Repo. To find more works, choose a <a href="/media" class="underline">fandom</a> or try our <a href="/works/search" class="underline">advanced search</a>.</p>      
      @else
        <h2 class="text-4xl font-serif">1-{{ $works->count() > 20 ? 20 : $works->count() }} of {{ $works->count() }} Works in <a href="/" class="underline decoration-dotted">Series1</a></h2>
        <div class="text-center">
          <button><a href="#">← Previous</a></button>
          <button>1</button>
          <button>2</button>
          <button>3</button>
          <button><a href="#">Next →</a></button>
        </div>
      @endif
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