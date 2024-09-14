<?php

use App\Http\Controllers\WorkController;
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

Route::get('/works', [WorkController::class, 'index']);

Route::get('/works/create', [WorkController::class, 'create']);

Route::post('/works', [WorkController::class, 'store']);

Route::get('/works/search', [WorkController::class, 'search']);

Route::get('/works/tags/{tag}', [WorkController::class, 'tags']);

Route::get('/works/{work_id}/chapters/{chapter_position}', [WorkController::class, 'show']);