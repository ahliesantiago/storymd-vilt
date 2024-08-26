<?php

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/works', function (Request $request) {
    return response()->json([
      'works' => Work::all(),
    ]);
});