<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [App\Http\Controllers\Api\CategoryAPIController::class, 'index']);
Route::post('/categories', [App\Http\Controllers\Api\CategoryAPIController::class, 'store']);
Route::put('/categories/{category}/update', [App\Http\Controllers\Api\CategoryAPIController::class, 'update']);
Route::delete('/categories/{category}/destroy', [App\Http\Controllers\Api\CategoryAPIController::class, 'destroy']);