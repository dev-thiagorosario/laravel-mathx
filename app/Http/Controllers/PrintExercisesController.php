<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class PrintExercisesController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        $exercises = session('exercises');
        return view('print-exercises', [
            'exercises' => $exercises,
            'appName'   => config('app.name'),
        ]);
    }
}
