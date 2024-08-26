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
          {{-- Hard-coded, to be replaced --}}
          <p><a href="/" class="underline decoration-dotted">Series</a></p>
        </div>
      </div>
    </div>
    <p>{{ date('d M Y', strtotime($work->chapters->first()['published_at'])) }}</p>
  </div>
  <p>
    {{-- Hard-coded, to be replaced --}}
    <a href="/" class="underline decoration-dotted font-bold">Warning1</a>,
    <a href="/" class="underline decoration-dotted font-bold">Warning2</a>,
    <a href="/" class="underline decoration-dotted">Relationship/Pair1</a>,
    <a href="/" class="underline decoration-dotted">Relationship/Pair2</a>,
    <a href="/" class="underline decoration-dotted">Relationship/Pair3</a>
  </p>

  <p>{{ $work->chapters->first()->summary }}</p>

  <p class="text-right">
    {{ $work['language_code'] ? 'Language: ' . $work->language->language_name : '' }}&nbsp;&nbsp;
    Words: {{ $work['word_count'] }}&nbsp;&nbsp;
    Chapters: {{ $work->chapters->count() }}/@if ( $work['is_complete'] ){{ $work->chapters->count() }} @else{{ $work['expected_chapter_count'] ? $work['expected_chapter_count'] : '?' }} @endif&nbsp;&nbsp;
    Comments: {{ $work['comment_count'] }}&nbsp;&nbsp;
    Kudos: {{ $work['kudos_count'] }}&nbsp;&nbsp;
    Bookmarks: {{ $work['bookmark_count'] }}&nbsp;&nbsp;
    Hits: {{ $work['hit_count'] }}&nbsp;&nbsp;
  </p>
</x-card>