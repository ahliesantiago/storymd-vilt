@props(['work'])

@php
// // WORK IN PROGRESS
// public function formatTags($work, $tags, $type){
//   $filteredMajorTags = $tags->filter(function ($tag) {
//     return $tag->type === $type && $tag->pivot->is_major;
//   });
//   $filteredOtherTags = $work->tags->filter(function ($tag) {
//     return $tag->type === $type && !$tag->pivot->is_major;
//   });
//   $formattedMajorTags = $filteredMajorTags->map(function ($tag){
//     return "<a href='/works/tags/{$tag->tag_name}' class='font-bold underline decoration-dotted'>$tag->tag_name</a>";
//   })->toArray();
//   $formattedOtherTags = $filteredOtherTags->map(function ($tag){
//     return "<a href='/works/tags/{$tag->tag_name}' class='underline decoration-dotted'>$tag->tag_name</a>";
//   })->toArray();
// }

  $warnings = $work->warnings->map(function ($warning){
    return "<a href='/works/tags/{$warning->warning_name}' class='font-bold underline decoration-dotted'>$warning->warning_name</a>";
  })->toArray();

  $majorRelationshipTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'relationship' && $tag->pivot->is_major;
  });
  $otherRelationshipTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'relationship' && !$tag->pivot->is_major;
  });
  $majorRelationships = $majorRelationshipTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='font-bold underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();
  $otherRelationships = $otherRelationshipTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();

  $majorCharacterTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'character' && $tag->pivot->is_major;
  });
  $otherCharacterTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'character' && !$tag->pivot->is_major;
  });
  $majorCharacters = $majorCharacterTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='font-bold underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();
  $otherCharacters = $otherCharacterTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();

  $majorAdditionalTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'additional' && $tag->pivot->is_major;
  });
  $otherAdditionalTags = $work->tags->filter(function ($tag) {
    return $tag->type === 'additional' && !$tag->pivot->is_major;
  });
  $majorTags = $majorAdditionalTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='font-bold underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();
  $otherTags = $otherAdditionalTags->map(function ($tag){
    return "<a href='/works/tags/{$tag->tag_name}' class='underline decoration-dotted'>$tag->tag_name</a>";
  })->toArray();

  $allTags = array_merge($warnings, $majorRelationships, $majorCharacters, $majorTags, $otherRelationships, $otherCharacters, $otherTags);
  $output = implode(', ', $allTags);

@endphp

{!! $output !!}