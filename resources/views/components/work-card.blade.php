@props(['work'])

<x-card class="list">
  <h2>
    <a class="text-red-800 underline" href="/works/{{ $work['id'] }}/chapters/1">{{ $work['title'] }}</a>
    by <a class="text-red-800 underline" href="#">{{ $work->creator->username }}</a>
  </h2>

  <p>Posted on {{ date('M-d-Y', strtotime($work['published_at'])) }}</p>
  
  <p>{{ $work->chapters->first()->summary }}</p>

  <p class="text-right">
    {{ $work['language_code'] ? 'Language: ' . $work->language->language_name : '' }}
    Words: {{ $work['word_count'] }}
    Chapters: {{ $work->chapters->count() }}/@if ( $work['is_complete'] ){{ $work->chapters->count() }} @else{{ $work['expected_number_of_chapters'] ? $work['expected_number_of_chapters'] : '?' }} @endif
    Comments: {{ $work['comment_count'] }}
    Kudos: {{ $work['kudos_count'] }}
    Bookmarks: {{ $work['bookmark_count'] }}
    Hits: {{ $work['hit_count'] }}
  </p>
</x-card>