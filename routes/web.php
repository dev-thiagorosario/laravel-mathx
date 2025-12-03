<?php

use App\Http\Controllers\GenerateExercisesController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/generateExercises', [GenerateExercisesController::class, 'generateExercises'])->name('generateExercises');
Route::get('/printExercises', [GenerateExercisesController::class, 'printExercises'])->name('printExercises');
Route::get('/exportExercises', [GenerateExercisesController::class, 'exportExercises'])->name('exportExercises');
