@extends('layout')

@section('title', $work['title'] . ' - Chapter ' . $chapter['position'] . ' - ' . $work->creator->username . ' | StoryMD')

@section('styles')
  @vite('resources/css/work.css')
@endsection

@section('content')
    <div class="work">
      <div class="nav-buttons text-center">
        @if ($chapter_count > 1)
          <button>Entire Work</button>
          @if ( $chapter['position'] != $chapter_count ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] + 1 }}">Next Chapter →</a></button> @endif      
          @if ( $chapter['position'] > 1 ) <button><a href="/works/{{ $work['id'] }}/chapters/{{ $chapter['position'] - 1 }}">← Previous Chapter</a></button> @endif      
          <button>Chapter Index ↓</button>
        @endif
        <button>Bookmark</button>
        <button>Mark for Later</button>
        <button>Mark as Read</button>
        <button>Mark as Seen</button>
        <button>Comments</button>
        <button>Share</button>
        <button>Download</button>
      </div>
      <x-card>
        <ul class="information">
          <li>
            <p>Rating:</p>
            <p>{{ $rating }}</p>
          </li>
          {{-- <li>
            <p>Archive Warning:</p>
            <p>{{ $work['warnings'] }}</p>
          </li>
          <li>
            <p>Category:</p>
            <p>{{ $work['category'] }}</p>
          </li>
          <li>
            <p>Fandom:</p>
            <p>{{ $work['main_fandom'] }}@if ($work['other_fandom']){{ ', '. implode(', ', $work['other_fandom']) }}@endif</p>
          </li>
          <li>
            <p>Relationships:</p>
            <p>{{ implode(", ", $work['relationships']) }}</p>
          </li>
          <li>
            <p>Characters:</p>
            <p>{{ implode(", ", $work['characters']) }}</p>
          </li>
          <li>
            <p>Additional Tags:</p>
            <p>{{ implode(", ", $work['tags']) }}</p>
          </li> --}}
          @if ($work['language_code'])
          <li>
            <p>Language:</p>
            <p>{{ $language }}</p>
          </li>
          @endif
          <li>
            <p>Stats:</p>
            <p>
              Published: {{ date('M-d-Y', strtotime($work['published_at'])) }}
              Completed: {{ date('M-d-Y', strtotime($work['completed_at'])) }}
              Words: {{ $work['word_count'] }}
              Chapters: {{ $chapter_count }}/{{ $work['expected_number_of_chapters'] ? $work['expected_number_of_chapters'] : '?' }}
              Comments: {{ $work['comment_count'] }}
              Kudos: {{ $work['kudos_count'] }}
              Bookmarks: {{ $work['bookmark_count'] }}
              Hits: {{ $work['hit_count'] }}
            </p>
          </li>
        </ul>
      </x-card>
    
      <aside class="mx-10">
        <h1 class="text-3xl text-center mt-6">{{ $work->title }}</h1>
        <h2 class="text-xl text-center mb-3">{{ $work['creator_id'] ? $work->creator->username : 'Anonymous' }}</h2>
        <hr>
        <h2 class="text-xl text-center m-3">
          <a href="#" class="underline">
            Chapter {{ $chapter['position'] }}{{ $chapter['title'] && ': ' . $chapter['title'] }}
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
        <button>Next Chapter →</button>
        <button>← Previous Chapter</button>
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
@endsection