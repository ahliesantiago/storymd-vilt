<x-layout :title="'Browse | StoryMD'">
  <div class="px-10 py-8">
    @if ($type == 'search')
      <h2 class="text-4xl font-serif mb-1">Search Results for "{{ $search_query }}"</h2>
      @if(count($works) != 0)
        <h3 class="text-2xl font-serif">{{ count($works) }} Found</h3>
      @else
        <p class="text-xl font-serif">No results found. You may want to <x-dotted-link url="#">edit your search</x-dotted-link> to make it less specific.</p>
      @endif
    @endif

    @unless(count($works) == 0)
      @if ($type == 'browse')
        <h2 class="text-4xl font-serif">Recent Works</h2>
        <p>These are some of the latest works posted to the Repo. To find more works, choose a <a href="/media" class="underline">fandom</a> or try our <a href="/works/search" class="underline">advanced search</a>.</p>      
      @elseif ($type !== 'search')
        <h2 class="text-4xl font-serif">1-{{ $works->count() > 20 ? 20 : $works->count() }} of {{ $works->count() }} Works in <a href="/" class="underline decoration-dotted">{{ str_replace('*s*', '/', $tag) }}</a></h2>
      @elseif ($type !== 'browse' && $works->count() > 20)
          <div class="text-center">
            <button><a href="#">← Previous</a></button>
            <button>1</button>
            <button>2</button>
            <button>3</button>
            <button><a href="#">Next →</a></button>
          </div>
      @endif
        @foreach($works as $work)
          @if($work->chapters->first()['is_published'] && $work['privacy'] == "public")
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
      @endif

    @endunless
  </div>
</x-layout>