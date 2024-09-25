<x-layout :title="'Browse | StoryMD'">
  @if(session('success'))
    <div
      class="text-center mt-1 py-1 bg-blue-400 border border-blue-600 text-white"
      x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    >
      {{ session('success') }}
    </div>
  @endif
  <div class="px-10 py-8">
    @if ($type == 'search')
      <h2 class="text-4xl font-serif mb-1">Search Results for "{{ $search_query }}"</h2>
      @if(count($works) != 0)
        <h3 class="text-2xl font-serif">{{ $total_works }} Found</h3>
      @else
        <p class="text-xl font-serif">No results found. You may want to <x-dotted-link url="#">edit your search</x-dotted-link> to make it less specific.</p>
      @endif
    @endif

    @unless(count($works) == 0)
      @if ($type == 'browse')
        <h2 class="text-4xl font-serif">Recent Works</h2>
        <p>These are some of the latest works posted to the Repo. To find more works, choose a <a href="/media" class="underline">fandom</a> or try our <a href="/works/search" class="underline">advanced search</a>.</p>      
      @endif

      @if (isset($total_works) && $total_works > 20)
        @if ($type == 'tags')
          <div class="bg-white">
            {{ $works->links('vendor.pagination.tailwind', [
              'tagLink' => '/',
              'tag' => $tag
              ]) }}
          </div>
        @elseif($type == 'search')
          <div class="bg-white">
            {{ $works->links() }}
          </div>
        @endif
      @endif

      @foreach($works as $work)
        @if($work->chapters->first()['is_published'] && $work['privacy'] != "private")
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