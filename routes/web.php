<?php

use App\Http\Controllers\GenerateExercisesController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintExercisesController;
use App\Http\Controllers\ExportExercisesController;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/generateExercises', [GenerateExercisesController::class, 'generateExercises'])->name('generateExercises');
Route::get('/printExercises', [PrintExercisesController::class, 'printExercises'])->name('printExercises');
Route::get('/exportExercises', [ExportExercisesController::class, 'exportExercises'])->name('exportExercises');
