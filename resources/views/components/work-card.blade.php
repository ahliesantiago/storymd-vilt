@props(['work'])

<x-card>
  <div class="flex justify-between">
    <div>
      <div class="flex">
        <div class="border border-red-200 w-16 h-16"></div>
        <div class="ms-3">
          <p>
            <a class="text-red-800 underline" href="/works/{{ $work['id'] }}/chapters/1">{{ $work['title'] }}</a>
            by <a class="text-red-800 underline" href="#">{{ $work->creator->username }}</a>
          </p>
          <p>
            @php
              $fandoms = $work->fandoms->map(function ($fandom) {
                return $fandom->pivot->is_major
                  ? "<a href='/works/tags/{$fandom->fandom_name}' class='font-bold underline decoration-dotted'>$fandom->fandom_name</a>"
                  : "<a href='/works/tags/{$fandom->fandom_name}' class='underline decoration-dotted'>$fandom->fandom_name</a>";
              })->implode(', ');
            @endphp
            {!! $fandoms !!}
          </p>
        </div>
      </div>
    </div>
    <div>
      <p class="text-right">{{ date('d M Y', strtotime($work->chapters->first()['published_at'])) }}</p>
      <p class="text-xs text-right">
        mark as:
          <x-dotted-link url="#">seen</x-dotted-link> |
          <x-dotted-link url="#">skipped</x-dotted-link> |
          <x-dotted-link url="#">read</x-dotted-link> |
          <x-dotted-link url="#">for later</x-dotted-link> |
          <x-dotted-link url="#">edit bookmark</x-dotted-link>
      </p>
    </div>
  </div>

  <p class="my-2">
    <x-work-tags :work="$work" />
  </p>

  <p class="my-3">{{ $work->chapters->first()->summary }}</p>

  <p class="text-right">
    Language: {{ $work->language->language_name }}&nbsp;&nbsp;
    Words: {{ $work['word_count'] }}&nbsp;&nbsp;
    Chapters: {{ $work->chapters->count() }}/@if ( $work['is_complete'] ){{ $work->chapters->count() }} @else{{ $work['expected_chapter_count'] ? $work['expected_chapter_count'] : '?' }} @endif&nbsp;&nbsp;
    {{-- Comments: {{ $work['comment_count'] }}&nbsp;&nbsp;
    Kudos: {{ $work['kudos_count'] }}&nbsp;&nbsp;
    Bookmarks: {{ $work['bookmark_count'] }}&nbsp;&nbsp;
    Hits: {{ $work['hit_count'] }}&nbsp;&nbsp; --}}
  </p>
</x-card>