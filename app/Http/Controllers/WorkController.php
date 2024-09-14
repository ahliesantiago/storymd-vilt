<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Work;
use App\Models\Chapter;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Fandom;
use App\Models\Rating;
use App\Models\Language;
use App\Models\Warning;

class WorkController extends Controller
{
  // Fetch and show all works
  public function index(){
    return view('works.index', [
      'works' => Work::latest()->get(),
      'type' => "browse"
    ]);
  }

  // Show a single work
  public function show($work_id, $chapter_position){
    $work = Work::find($work_id);
    $chapter = Chapter::where('work_id', $work_id)->where('position', $chapter_position)->first();
  
    if($work && $chapter){
      return view('works.show', [
        'work' => $work,
        'chapter' => $chapter,
        'chapter_position' => $chapter_position,
        'final_chapter' => Chapter::where('work_id', $work_id)->orderBy('position', 'desc')->first(),
        'chapter_count' => Chapter::where('work_id', $work_id)->count()
      ]);
    }else{
      abort('404');
    }
  }

  public function tags($tag) {
    $escapedTag = str_replace('*s*', '/', $tag);

    return view('works.index', [
      'works' => Work::latest()
        ->filter(['tag' => $escapedTag])->get(),
      'type' => "tags",
      'tag' => $tag
    ]);
  }

  public function search(Request $request) {
    $search_query = $request->input('work_search.query');
    return view('works.index', [
      'works' => Work::latest()
        ->filter(['search' => $search_query])->get(),
      'type' => "search",
      'search_query' => $search_query,
    ]);
  }

  public function advanced_search(Request $request) {
    // dd($request);
    return view('search');
  }

  // Shows the form for Work creation
  public function create(){
    return view('works.create', [
      'languages' => Language::all(),
      'ratings' => Rating::all(),
      'warnings' => Warning::all(),
      'fandoms' => Fandom::all(),
      'categories' => Category::all(),
      'relationships' => Tag::where('type', 'relationship')->get(),
      'characters' => Tag::where('type', 'character')->get(),
      'additional_tags' => Tag::where('type', 'additional')->get(),
    ]);
  }

  // Handles Work submission and storage in database
  public function store(Request $request){
    // dd($request->all());
    $workInput = $request->validate([
      'title' => ['required', 'min:1', 'max:255'],
      'privacy' => 'required',
      'commenting_rule' => 'required',
      'language_code' => 'required',
      'rating_id' => 'required',
    ]);

    $chapterInput = $request->validate([
      'content' => ['required', 'min:200', 'max:500000'],
      'summary' => ['required', 'min:5', 'max:1250'],
      'beginning_notes' => 'max:5000',
      'end_notes' => 'max:5000',
    ]);

    $tagInputs = $request->validate([
      'warnings' => 'required',
      'fandoms' => 'required',
      'categories' => 'required',
    ]);

    // $otherTags = [
    //   'relationships',
    //   'characters',
    //   'additional_tags',
    // ];

    return redirect('/');
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
