<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use App\Models\User;
use App\Models\Work;
use App\Models\Fandom;
use App\Models\Rating;
use App\Models\Chapter;
use App\Models\Warning;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
{
  // Fetch and show all works
  public function index(){
    return view('works.index', [
      'works' => Work::latest()->paginate(20),
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
        ->filter(['tag' => $escapedTag])->paginate(20),
      'total_works' => Work::latest()->filter(['tag' => $escapedTag])->count(),
      'type' => "tags",
      'tag' => $tag
    ]);
  }

  public function search(Request $request) {
    $search_query = $request->input('work_search.query');
    return view('works.index', [
      'works' => Work::latest()
        ->filter(['search' => $search_query])->paginate(20)->appends(['work_search[query]' => $search_query]),
      'total_works' => Work::latest()->filter(['search' => $search_query])->count(),
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
    return view('works.form', [
      'type' => "create",
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

  public function transformInput($input){
    $transformedInput = nl2br($input);
    $transformedInput = '<p>' . str_replace(array('<br />', '<br>'), '</p><p>', $transformedInput) . '</p>';
    return $transformedInput;
  }

  // Handles Work submission and storage in database
  public function store(Request $request){
    $formFields = $request->validate([
      'title' => ['required', 'max:255'],
      'privacy' => 'required',
      'commenting_rule' => 'required',
      'language_code' => 'required',
      'rating_id' => 'required',
      'content' => ['required', 'min:200', 'max:500000'],
      'summary' => ['required', 'min:5', 'max:1250'],
      'beginning_notes' => 'max:5000',
      'end_notes' => 'max:5000',
      'warnings' => 'required',
      'fandoms' => ['required', 'integer'],
      'categories' => 'required',
    ]);

    if($request->hasFile('cover_image')){
      $formFields['cover_image'] = $request->file('cover_image')->store('covers', 'public');
    }

    $work = Work::create([
      'title' => $formFields['title'],
      'cover_image' => $formFields['cover_image'] ?? null,
      'creator_id' => 1, // Will need to change this to the logged-in user once registration is finalized
      'privacy' => $formFields['privacy'],
      'is_complete' => $request->input('expected_chapter_count') == 1 ? 1 : 0,
      'expected_chapter_count' => $request->input('expected_chapter_count'),
      'commenting_rule' => $formFields['commenting_rule'],
      'is_comment_moderated' => $request->input('is_comment_moderated') ? 1 : 0,
      'word_count' => str_word_count($formFields['content']),
      'language_code' => $formFields['language_code'],
      'rating_id' => $formFields['rating_id'],
      'completed_at' => $request->input('expected_chapter_count') == 1 ? now() : null,
    ]);

    $transformedContent = $this->transformInput($formFields['content']);

    $chapter = Chapter::create([
      'work_id' => $work->id,
      'position' => 1,
      'content' => $transformedContent,
      'summary' => $formFields['summary'],
      'beginning_notes' => $formFields['beginning_notes'],
      'end_notes' => $formFields['end_notes'],
      'word_count' => str_word_count($formFields['content']),
      'is_published' => $work->privacy == 'private' ? 0 : 1,
      'published_at' => $work->privacy == 'private' ? null : now(),
    ]);

    $work->warnings()->attach($formFields['warnings']);
    $work->categories()->attach($formFields['categories']);
    $work->fandoms()->attach($formFields['fandoms'], ['is_major' => 1]);

    // This will check the received tags and include them in the tags array to be attached if it is not null
    $tags = array_filter([
      $request->input('relationships'),
      $request->input('characters'),
      $request->input('additional_tags'),
    ]);
    if(!empty($tags)){
      $work->tags()->attach($tags);
    }

    return redirect()->route('new-work.show', ['work_id' => $work->id, 'chapter_position' => 1])
      ->with('success', 'Work created successfully');
  }

  // Shows the form for editing Work
  public function edit(Work $work){
    // dd($work);
    return view('works.form', [
      'type' => "edit",
      'work' => $work,
      
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

  // Handles edit form submission and actual update of Work record in the database
  public function update(Request $request){
    dd($request);
  }

  // Handles deletion of a Work from the database
  public function destroy(){

  }
}
