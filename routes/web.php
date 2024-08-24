<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Work;
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
  return view('works_list', ['works' => Work::all()]);
});

Route::get('/works/{work_id}', function ($work_id) {
  return view('work', ['work' => Work::find($work_id)]);
});

Route::get('/works/{work_id}/chapters/{chapter_id}', function ($work_id, $chapter_id) {
  return response('Story '. $work_id . ' Chapter ' . $chapter_id);
})->where('work_id', '[0-9]+')->where('chapter_id', '[0-9]+');

Route::get('/works/search', function (Request $request) {
  // dd($request);
  return view('search');
  // return response($request->input('work_search.query'));
  // return response($request->work_search['query']);
  // works/search?work_search[query]=test
  // works/search?work_search%5Bquery%5D=test&work_search%5Btitle%5D=&work_search%5Bcreators%5D=&work_search%5Brevised_at%5D=&work_search%5Bcomplete%5D=&work_search%5Bcrossover%5D=&work_search%5Bsingle_chapter%5D=0&work_search%5Bword_count%5D=&work_search%5Blanguage_id%5D=&work_search%5Bfandom_names%5D=&work_search%5Brating_ids%5D=&work_search%5Bcharacter_names%5D=&work_search%5Brelationship_names%5D=&work_search%5Bfreeform_names%5D=&work_search%5Bhits%5D=&work_search%5Bkudos_count%5D=&work_search%5Bcomments_count%5D=&work_search%5Bbookmarks_count%5D=&work_search%5Bsort_column%5D=_score&work_search%5Bsort_direction%5D=desc&commit=Search
  // works/search?work_search%5Bsort_column%5D=revised_at&work_search%5Bother_tag_names%5D=&work_search%5Bexcluded_tag_names%5D=&work_search%5Bcrossover%5D=&work_search%5Bcomplete%5D=&work_search%5Bwords_from%5D=&work_search%5Bwords_to%5D=&work_search%5Bdate_from%5D=&work_search%5Bdate_to%5D=&work_search%5Bquery%5D=test&work_search%5Blanguage_id%5D=&commit=Sort+and+Filter&tag_id=TAG
  
});