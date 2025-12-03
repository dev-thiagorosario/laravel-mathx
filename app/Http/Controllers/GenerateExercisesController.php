<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\GenerateExercisesRequest;
use App\Exceptions\NoOperationSelectedException;

class GenerateExercisesController extends Controller
{
    public function generateExercises(GenerateExercisesRequest $request)
    {
        $validated = $request->validated();

        $operationMap = [
            'check_sum'           => 'sum',
            'check_subtraction'   => 'subtraction',
            'check_multiplication'=> 'multiplication',
            'check_division'      => 'division',
        ];

        $operations = [];

        foreach ($operationMap as $field => $operationName) {
            if ($request->boolean($field)) {
                $operations[] = $operationName;
            }
        }

        if (empty($operations)) {
            throw new NoOperationSelectedException();
        }

        $min = (int) $validated['number_one'];
        $max = (int) $validated['number_two'];

        $numberExercises = (int) $validated['number_exercises'];

        $exercises = [];
        for ($index = 1; $index <= $numberExercises; $index++) {
            $operation = $operations[array_rand($operations)];
            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            $exercise = '';
            $sollution = '';

            switch ($operation) {
                case 'sum':
                    $exercise = "{$number1} + {$number2} = ";
                    $sollution = $number1 + $number2;
                break;
                case 'subtraction':
                    $exercise = "{$number1} - {$number2} = ";
                    $sollution = $number1 - $number2;
                break;
                case 'multiplication':
                    $exercise = "{$number1} x {$number2} = ";
                    $sollution = $number1 * $number2;
                break;
                case 'division':
                    $exercise = "{$number1} / {$number2} = ";
                    $sollution = $number1 / $number2;
                break;

                $exercises[] = [
                    'exercise_number' => $index,
                    'exercise' => $exercise,
                    'sollution' => "$exercise $sollution"
                ];

            }
        }

    }
}
