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

Route::get('/works/create', [WorkController::class, 'create']);

Route::post('/works', [WorkController::class, 'store']);

Route::get('/works/{work}/edit', [WorkController::class, 'edit']);

Route::put('/works/{work}', [WorkController::class, 'update']);

Route::delete('/works/{work}', [WorkController::class, 'destroy']);

Route::get('/works/search', [WorkController::class, 'search']);

Route::get('/works/tags/{tag}', [WorkController::class, 'tags']);

Route::get('/works/{work_id}/chapters/{chapter_position}', [WorkController::class, 'show'])->name('new-work.show');

Route::get('/register', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/users/{username}', [UserController::class, 'show']);