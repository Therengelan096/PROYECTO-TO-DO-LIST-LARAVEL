<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);

Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::resource('tasks', TaskController::class);