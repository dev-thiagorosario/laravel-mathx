<?php

use App\Http\Controllers\ExportExercisesController;
use App\Http\Controllers\GenerateExercisesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PrintExercisesController;
use Illuminate\Support\Facades\Route;

Route::get('/', MainController::class)->name('home');
Route::post('/generateExercises', GenerateExercisesController::class)->name('generateExercises');

Route::middleware('exercises.exist')->group(function () {
    Route::get('/print-exercises', PrintExercisesController::class)->name('printExercises');
    Route::get('/export-exercises', ExportExercisesController::class)->name('exportExercises');
});
