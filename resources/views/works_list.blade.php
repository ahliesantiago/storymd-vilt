<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Browse</title>
</head>
<body>
  <h1>Works</h1>

  @unless(count($works) == 0)
    @foreach($works as $work)
      <div class="work">
        <h2><a href="/works/{{ $work['id'] }}">{{ $work['title'] }}</a> by {{ $work['creator'] }}</h2>
        <p>Posted on {{ $work['created_at'] }}</p>
        <p>Fandom: {{ $work['main_fandom'] }}</p>
        <p>{{ $work['summary'] }}</p>
        <p>{{ $work['language_id'] ? 'Language: ' . $work['language_id'] . ' | ' : '' }} Words: {{ $work['word_count'] }} | Chapters: {{ $work['chapter_count'] }}/{{ $work['expected_number_of_chapters'] ? $work['expected_number_of_chapters'] : '?' }}</p>
        <p>Comments: {{ $work['comment_count'] }} | Kudos: {{ $work['kudos_count'] }} | Bookmarks: {{ $work['bookmark_count'] }} | Hits: {{ $work['hit_count'] }} </p>
      </div>
    @endforeach

  @else
    <p>No works found...</p>

  @endunless
</body>
</html>