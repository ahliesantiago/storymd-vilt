@props(['work', 'type', 'name'])

@php
  $type_tags = $work->tags->filter(function ($tag) use ($name) {
    return $tag->type === $name;
  })
@endphp

@if ($type_tags-> count() > 0)
  <p class="col-span-1">{{ $type }}:</p>
  <p class="col-span-3">
    {!!
      $type_tags
        ->sortByDesc(function ($tag){
          return $tag->pivot->is_major;
        })
        ->map(function ($tag) {
          return "<a href='/works/tags/{$tag->tag_name}' class='underline decoration-dotted'>$tag->tag_name</a>";
        })
        ->implode(', ')
    !!}
  </p>
@endif