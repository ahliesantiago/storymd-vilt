@extends('layout')

@section('title', 'Browse - StoryMD')

@section('content')
  
  @unless(count($works) == 0)
    @foreach($works as $work)
      <x-work-card :work="$work" />
    @endforeach

  @else
    <p>No works found...</p>

  @endunless

@endsection