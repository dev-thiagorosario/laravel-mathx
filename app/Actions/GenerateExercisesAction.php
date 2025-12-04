<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Arr;
use App\Exceptions\NoOperationSelectedException;

class GenerateExercisesAction
{
    public function handle(array $data): array
    {
        $operationMap = [
            'check_sum'            => 'sum',
            'check_subtraction'    => 'subtraction',
            'check_multiplication' => 'multiplication',
            'check_division'       => 'division',
        ];

        $operations = [];

        foreach ($operationMap as $field => $operationName) {
            if (!empty($data[$field]) && $data[$field]) {
                $operations[] = $operationName;
            }
        }

        if (empty($operations)) {
            throw new NoOperationSelectedException();
        }

        $min = (int) $data['number_one'];
        $max = (int) $data['number_two'];
        $numberExercises = (int) $data['number_exercises'];

        $exercises = [];

        for ($index = 1; $index <= $numberExercises; $index++) {
            $operation = Arr::random($operations);

            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            if ($operation === 'division') {
                if ($number2 === 0) {
                    $number2 = 1;
                }

                $number1 = $number1 - ($number1 % $number2);
            } elseif ($operation === 'subtraction') {
                if ($number1 < $number2) {
                    [$number1, $number2] = [$number2, $number1];
                }
            }

            switch ($operation) {
                case 'sum':
                    $exercise = "{$number1} + {$number2} = ";
                    $solution = $number1 + $number2;
                    break;
                case 'subtraction':
                    $exercise = "{$number1} - {$number2} = ";
                    $solution = $number1 - $number2;
                    break;
                case 'multiplication':
                    $exercise = "{$number1} x {$number2} = ";
                    $solution = $number1 * $number2;
                    break;
                case 'division':
                    $exercise = "{$number1} / {$number2} = ";
                    $solution = (int) ($number1 / $number2);
                    break;
            }

            $exercises[] = [
                'exercise_number' => $index,
                'exercise'        => $exercise,
                'solution'        => "{$exercise} {$solution}",
            ];
        }

        return $exercises;
    }
}

