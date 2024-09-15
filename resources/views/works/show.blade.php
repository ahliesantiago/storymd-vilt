{{-- @if (is_signed_in)

@else

should be 404

@endif --}}

<x-layout :title="$work['title'] . ' - Chapter ' . $chapter['position'] . ' - ' . $work->creator->username . ' | StoryMD'">

@section('styles')
  @vite('resources/css/work.css')
@endsection

@if(session('success'))
  <div
    class="text-center mt-1 py-1 bg-blue-400 border border-blue-600 text-white"
    x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
  >
    {{ session('success') }}
  </div>
@endif

  <div class="work">
    <div class="nav-buttons text-center">
      @if ($chapter_count > 1)
        @if($chapter_position == 'all')
          <button>Chapter by Chapter</button>
        @endif
        <button>Entire Work</button>
        @if ( $chapter['position'] != $chapter_count ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] + 1 }}">Next Chapter →</a></button> @endif
        @if ( $chapter['position'] > 1 ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] - 1 }}">← Previous Chapter</a></button> @endif
        <button>Chapter Index ↓</button>
      @endif
      <button>Comments</button>
      <button>Share</button>
      <button>Download</button>
    </div>
    <div class="nav-buttons text-center">
      <button>Mark as Seen</button>
      {{-- <button>Unmark as Seen</button> --}}
      <button>Mark as Skipped</button>
      {{-- <button>Unmark as Skipped</button> --}}
      <button>Mark as Read</button>
      {{-- <button>Unmark as Read</button> --}}
      <button>Mark for Later</button>
      {{-- <button>Unmark for Later</button> --}}
      <button>Bookmark</button>
    </div>

    <x-card class="mx-4">
      <div class="grid grid-cols-4 gap-1">
        <p class="col-span-1">Rating:</p>
        <p class="col-span-3">{{ $work->rating->rating_name }}</p>
        <p class="col-span-1 font-bold">Archive Warning{{ $work->warnings->count() > 1 ? 's' : '' }}:</p>
        <p class="col-span-3 font-bold">
          {!!
            $work->warnings->map(function ($warning) {
              return "<a href='/works/tags/{$warning->warning_name}' class='underline decoration-dotted'>$warning->warning_name</a>";
            })->implode(', ')
          !!}
        </p>
        <p class="col-span-1">Category:</p>
        <p class="col-span-3">
          {!!
            $work->categories->map(function ($category) {
              if(strpos($category->category_name, '/')){
                $category_name = str_replace('/', '*s*', $category->category_name);

                return "<a href='/works/tags/{$category_name}' class='underline decoration-dotted'>$category->category_name</a>";
              }else{
                return "<a href='/works/tags/{$category->category_name}' class='underline decoration-dotted'>$category->category_name</a>";
              }
            })->implode(', ')
          !!}
        </p>
        <p class="col-span-1">Fandom:</p>
        <p class="col-span-3">
          {!!
            $work->fandoms->map(function ($fandom) {
              return "<a href='/works/tags/{$fandom->fandom_name}' class='underline decoration-dotted'>$fandom->fandom_name</a>";
            })->implode(', ')
          !!}
        </p>
        <x-work-type-tags :work="$work" :type="'Relationships'" :name="'relationship'" />
        <x-work-type-tags :work="$work" :type="'Characters'" :name="'character'" />
        <x-work-type-tags :work="$work" :type="'Additional Tags'" :name="'additional'" />
        <p class="col-span-1">Language:</p>
        <p class="col-span-3">{{ $work->language->language_name }}</p>
        <p class="col-span-1">Stats:</p>
        <p class="col-span-3">
          Published: {{ date('d M Y', strtotime($work->chapters->first()['published_at'])) }}&nbsp;&nbsp;
          @if ($work['is_complete'] && $chapter_count == $final_chapter['position'] )
          Completed: {{ date('d M Y', strtotime($final_chapter['published_at'])) }}&nbsp;&nbsp;
          @endif
          Words: {{ $work['word_count'] }}&nbsp;&nbsp;
          Chapters: {{ $chapter_count }}/@if ( $work['is_complete'] ){{ $chapter_count }}@else{{ $work['expected_chapter_count'] ? $work['expected_chapter_count'] : '?' }} @endif&nbsp;&nbsp;
          {{-- Comments: {{ $work['comment_count'] }}&nbsp;&nbsp;
          Kudos: {{ $work['kudos_count'] }}&nbsp;&nbsp;
          Bookmarks: {{ $work['bookmark_count'] }}&nbsp;&nbsp;
          Hits: {{ $work['hit_count'] }}&nbsp;&nbsp; --}}
        </p>
        </div>
        </li>
      </ul>
    </x-card>
  
    <aside class="mx-10">
      <h1 class="text-3xl text-center mt-6">{{ $work->title }}</h1>
      <h2 class="text-xl text-center mb-3">{{ $work['creator_id'] ? $work->creator->username : 'Anonymous' }}</h2>
      <hr>
      <h2 class="text-xl text-center m-3">
        <a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] }}" class="underline">
          Chapter {{ $chapter['position'] }}{{ $chapter['chapter_title'] ? ': ' . $chapter['chapter_title'] : '' }}
        </a>
      </h2>
      <h3 class="text-xl">Summary:</h3>
      <hr>
      <p class="my-3">{{ $chapter['summary'] }}</p>
    
      @if ($chapter['beginning_notes'])
        <h3 class="text-xl">Notes:</h3>
        <hr>
        <p class="my-3">{{ $chapter['beginning_notes'] }}</p>
        @if ($chapter['end_notes'])
          <p>(See the end of the work for more notes.)</p>
        @endif
      @endif
    </aside>
  
    <main class="my-10">
      {!! str_replace("</p>", "</p><br>", $chapter['content']) !!}
    </main>
  
    @if ($chapter['end_notes'])
      <div class="footnotes m-10">
        <h3 class="text-xl">Notes:</h3>
        <hr>
        <p class="my-3">{{ $chapter['end_notes'] }}</p>
      </div>
    @endif
  
    <div class="nav-buttons text-center">
      <button>↑ Top</button>
      @if ($chapter_count > 1)
        @if ( $chapter['position'] != $chapter_count ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] + 1 }}">Next Chapter →</a></button> @endif
        @if ( $chapter['position'] > 1 ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] - 1 }}">← Previous Chapter</a></button> @endif
      @endif
      <button>Kudos ♥</button>
      <button>Bookmark</button>
      <button>Comments</button>
    </div>
  
    <div class="kudoses">
      <ul>
        <li></li>
      </ul>
    </div>
  
    <div class="comments">
      <form class="border bg-stone-300 p-5 mt-10 mb-5" action="POST">
        <p>Commenting as <span class="font-bold">usernamehere</span></p>
        <textarea class="w-full mt-10 mb-5" name="comment" id="comment" rows="10"></textarea>
        <div class="flex justify-between">
          <p class="self-center">10000 characters left</p>
          <button>Comment</button>
        </div>
      </form>
    </div>
  </div>
</x-layout>