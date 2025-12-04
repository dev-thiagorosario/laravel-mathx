<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ExportExercisesController extends Controller
{
    public function __invoke(): RedirectResponse|Response
    {
        $exercises = session('exercises');

        $filename = sprintf(
            'exercises_%s_%s.txt',
            str_replace(' ', '_', strtolower(config('app.name'))),
            now()->format('Y-m-d')
        );

        $lines = [];

        foreach ($exercises as $exercise) {
            $lines[] = $exercise['exercise_number'] . ' > ' . $exercise['exercise'];
        }

        $lines[] = '';

        $lines[] = 'Solutions';
        $lines[] = str_repeat('-', 20);

        foreach ($exercises as $exercise) {
            $lines[] = $exercise['exercise_number'] . ' > ' . $exercise['solution'];
        }

        $content = implode(PHP_EOL, $lines) . PHP_EOL;

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
