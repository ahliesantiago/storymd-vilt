<?php

use App\Models\User;
use App\Models\Chapter;
use App\Models\Rating;
use App\Models\Language;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

Route::get('/', function () {
  return view('home', ['user' => 'fangirl']);
  // return Inertia::render('Home');
});

Route::get('/about', function () {
  return view('about');
  // return inertia('About', ['user' => 'fangirl']);
});

Route::get('/browse', function () {
  return view('works_list', [
    'works' => Work::with(['creator', 'chapters', 'language'])->get(),
  ]);
});

Route::get('/works/{work_id}/chapters/{chapter_position}', function ($work_id, $chapter_position) {
  $work = Work::find($work_id);
  $chapter = Chapter::where('work_id', $work_id)->where('position', $chapter_position)->first();

  if($work && $chapter){
    return view('work', [
      'work' => $work,
      'rating' => Rating::find(Work::find($work_id)->rating_id)->rating_name,
      'language' => Work::find($work_id)->language_code ? Language::find(Work::find($work_id)->language_code)->language_name : null,
      'chapter' => $chapter,
      'chapter_count' => Chapter::where('work_id', $work_id)->count()
    ]);
  }else{
    abort('404');
  }
});

Route::get('/works/search', function (Request $request) {
  // dd($request);
  return view('search');
});