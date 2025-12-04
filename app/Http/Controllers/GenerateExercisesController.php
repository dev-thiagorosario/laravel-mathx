<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GenerateExercisesAction;
use App\Http\Requests\GenerateExercisesRequest;
use Illuminate\Contracts\View\View;

class GenerateExercisesController extends Controller
{
    public function __invoke(
        GenerateExercisesRequest $request,
        GenerateExercisesAction $action
    ): View {
        $exercises = $action->handle($request->validated());
        session()->put('exercises', $exercises);

        return view('operations', compact('exercises'));
    }
}
