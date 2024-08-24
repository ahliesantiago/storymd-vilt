<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $work['title'] }} - {{ $work['creator'] }}</title>
  @vite('resources/css/app.css')
  @vite('resources/css/work.css')
</head>
<body>
  <div class="nav-buttons text-center">
    <button class="appearance-none">Entire Work</button>
    <button class="appearance-auto">Next Chapter →</button>
    <button>← Previous Chapter</button>
    <button>Chapter Index</button>
    <button>Bookmark</button>
    <button>Mark for Later</button>
    <button>Mark as Read</button>
    <button>Mark as Seen</button>
    <button>Comments</button>
    <button>Share</button>
    <button>Download</button>
  </div>
  <div class="information border border-gray-500 m-1 p-2">
    <ul>
      <li>
        <p>Rating:</p>
        <p>{{ $work['rating'] }}</p>
      </li>
      <li>
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
      </li>
      <li>
        <p>Language:</p>
        <p>{{ $work['language_id'] }}</p>
      </li>
      <li>
        <p>Stats:</p>
        <p>
          Published: {{ $work['published_at'] }}
          Completed: {{ $work['completed_at'] }}
          Words: {{ $work['word_count'] }}
          Chapters: {{ $work['chapter_count'] }}/{{ $work['expected_number_of_chapters'] ? $work['expected_number_of_chapters'] : '?' }}
          Comments: {{ $work['comment_count'] }}
          Kudos: {{ $work['kudos_count'] }}
          Bookmarks: {{ $work['bookmark_count'] }}
          Hits: {{ $work['hit_count'] }}
        </p>
      </li>
    </ul>

      <p> </p>
  </div>

  <h1 class="text-3xl text-center mt-6">{{ $work['title'] }}</h1>
  <h2 class="text-2xl text-center mb-3">{{ $work['creator'] ? $work['creator'] : 'Anonymous' }}</h2>



Stilled into frame
Anonymous
Summary:

    Princess Rhanerya Targaryen is finally returning home, after almost eleven years and with her son, Prince Jacaerys Targaryen. The entirely of Westeros is holding its breath, especially the royal family.
    Who is to say that the flames won't burn the monarchy for good this time?

Notes:

    Hiii
    I got this idea while half asleep. Hope you guys enjoy!
    Some things to point out—
    Westeros is a monarchy, but it's like England.
    Aegon is fourteen (turning fifteen!!!), Helaena (darling girl) is twelve, Aemond (big tough guy) is eleven, Daeron (pookie baby) is ten.
    Alicent married Viserys as soon as she turned eighteen (bastard groomed her and she had no choice in the marriage) and is thirty two, same as Rhaenyra.

(See the end of the work for more notes.)
Chapter 1



  <div class="summary">
    {{ $work['summary'] }}
  </div>
  <div class="top_note">
  </div>
  <main>
    <h3>Chapter 1</h3>
    {{ $work['content'] }}
  </main>
  <div class="footnote">
  </div>
</body>
</html>