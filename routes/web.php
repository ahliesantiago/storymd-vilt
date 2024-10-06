<?php

use App\Http\Controllers\WorkController;
use App\Http\Controllers\UserController;
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

Route::get('/works/create', [WorkController::class, 'create'])->middleware('auth');

Route::post('/works', [WorkController::class, 'store'])->middleware('auth');

Route::get('/works/{work}/edit', [WorkController::class, 'edit'])->middleware('auth');

Route::put('/works/{work}', [WorkController::class, 'update'])->middleware('auth');

Route::delete('/works/{work}', [WorkController::class, 'destroy'])->middleware('auth');

Route::get('/works/search', [WorkController::class, 'search']);

Route::get('/works/tags/{tag}', [WorkController::class, 'tags']);

Route::get('/works/{work_id}/chapters/{chapter_position}', [WorkController::class, 'show'])->name('new-work.show');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store'])->middleware('guest');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/users/{username}', [UserController::class, 'show']);