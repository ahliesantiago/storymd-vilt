<x-layout :title="'Browse | StoryMD'">
  <div class="px-10 py-8">
    @if ($type == 'search')
      <h2 class="text-4xl font-serif">Search Results for "{{ $search_query }}"</h3>
    @endif

    @unless(count($works) == 0)
      @if ($type == 'browse')
        <h2 class="text-4xl font-serif">Recent Works</h2>
        <p>These are some of the latest works posted to the Repo. To find more works, choose a <a href="/media" class="underline">fandom</a> or try our <a href="/works/search" class="underline">advanced search</a>.</p>      
      @elseif ($type !== 'search')
        <h2 class="text-4xl font-serif">1-{{ $works->count() > 20 ? 20 : $works->count() }} of {{ $works->count() }} Works in <a href="/" class="underline decoration-dotted">{{ str_replace('*s*', '/', $tag) }}</a></h2>
        @if ($works->count() > 20)
          <div class="text-center">
            <button><a href="#">← Previous</a></button>
            <button>1</button>
            <button>2</button>
            <button>3</button>
            <button><a href="#">Next →</a></button>
          </div>
        @endif
      @endif
        @foreach($works as $work)
          @if($work->chapters->first()['is_published'] && $work['is_private'] == 0)
            <x-work-card :work="$work" />
          @endif
        @endforeach
        
    @else

      @if ($type !== 'search')
        <h2 class="text-4xl font-serif">
          No works found
          @if (isset($tag))
            in <a href="/" class="underline decoration-dotted">{{ str_replace('*s*', '/', $tag) }}</a>
          @endif
        </h2>
      @else
        <p>No results found. You may want to <x-dotted-link url="#">edit your search</x-dotted-link> to make it less specific.</p>
      @endif

    @endunless
  </div>
</x-layout>