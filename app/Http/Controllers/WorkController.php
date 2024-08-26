<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Chapter;
use App\Models\Rating;
use App\Models\Language;
use App\Models\Work;

class WorkController extends Controller
{
  // Fetch and show all works
  public function index(){
    return view('works.index', [
      'works' => Work::with(['creator', 'chapters', 'language'])->latest()->get(),
    ]);
  }

  // Show a single work
  public function show($work_id, $chapter_position){
    $work = Work::find($work_id);
    $chapter = Chapter::where('work_id', $work_id)->where('position', $chapter_position)->first();
  
    if($work && $chapter){
      return view('works.show', [
        'work' => $work,
        'rating' => Rating::find(Work::find($work_id)->rating_id)->rating_name,
        'language' => Work::find($work_id)->language_code ? Language::find(Work::find($work_id)->language_code)->language_name : null,
        'chapter' => $chapter,
        'final_chapter' => Chapter::where('work_id', $work_id)->orderBy('position', 'desc')->first(),
        'chapter_count' => Chapter::where('work_id', $work_id)->count()
      ]);
    }else{
      abort('404');
    }
  }

  public function tags($tag) {
    return view('works.index', [
      'works' => Work::with(['creator', 'chapters', 'language'])
        ->latest()->filter(['tag' => $tag])->get(),
    ]);
  }

  public function search(Request $request) {
    // dd($request);
    return view('search');
  }

  // Shows the form for Work creation
  public function create(){

  }

  // Handles Work submission and storage in database
  public function store(){

  }

  // Shows the form for editing Work
  public function edit(){

  }

  // Handles edit form submission and actual update of Work record in the database
  public function update(){

  }

  // Handles deletion of a Work from the database
  public function destroy(){

  }
}
