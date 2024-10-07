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
      @if ($work['creator_id'] == auth()->id())
        <x-button><a href="/works/{{ $work['id'] }}/edit">Edit Work</a></x-button>
      @endif
      @if ($chapter_count > 1)
        @if($chapter_position == 'all')
          <x-button>Chapter by Chapter</x-button>
        @endif
        <x-button>Entire Work</x-button>
        @if ( $chapter['position'] > 1 ) <x-button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] - 1 }}">← Previous Chapter</a></x-button> @endif
        @if ( $chapter['position'] != $chapter_count ) <x-button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] + 1 }}">Next Chapter →</a></x-button> @endif
        <x-button>Chapter Index ↓</x-button>
      @endif
      <x-button>Comments</x-button>
      <x-button>Share</x-button>
      <x-button>Download</x-button>
    </div>
    <div class="nav-buttons text-center">
      <x-button>Mark as Seen</x-button>
      {{-- <x-button>Unmark as Seen</x-button> --}}
      <x-button>Mark as Skipped</x-button>
      {{-- <x-button>Unmark as Skipped</x-button> --}}
      <x-button>Mark as Read</x-button>
      {{-- <x-button>Unmark as Read</x-button> --}}
      <x-button>Mark for Later</x-button>
      {{-- <x-button>Unmark for Later</x-button> --}}
      <x-button>Bookmark</x-button>
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
      @if ($chapter['position'] == 1 && $work->cover_image)
        <img class="w-40 h-64 float-right" src="{{ asset('storage/' . $work->cover_image) }}" />
      @endif
      <h1 class="text-3xl text-center mt-6">{{ $work->title }}</h1>
      <h2 class="text-xl text-center mb-3">
        @if ($work['creator_id'])
          <x-dotted-link url="/users/{{$work->creator->username}}">
            {{ $work->creator->username }}
          </x-dotted-link>
        @else
          Anonymous
        @endif
      </h2>
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
      <x-button>↑ Top</x-button>
      @if ($chapter_count > 1)
        @if ( $chapter['position'] != $chapter_count ) <x-button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] + 1 }}">Next Chapter →</a></x-button> @endif
        @if ( $chapter['position'] > 1 ) <x-button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] - 1 }}">← Previous Chapter</a></x-button> @endif
      @endif
      <x-button>Kudos ♥</x-button>
      <x-button>Bookmark</x-button>
      <x-button>Comments</x-button>
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
          <x-button>Comment</x-button>
        </div>
      </form>
    </div>
  </div>
</x-layout>