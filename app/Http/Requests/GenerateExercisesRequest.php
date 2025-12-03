<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateExercisesRequest extends FormRequest
{
        public function rules(): array
    {
        $operations = [
            'check_sum',
            'check_subtraction',
            'check_multiplication',
            'check_division',
        ];

        $rules = [];

        foreach ($operations as $operation) {
            $others = array_diff($operations, [$operation]);
            $rules[$operation] = 'required_without_all:' . implode(',', $others) . '|boolean';
        }

        $rules['number_one']         = 'required|integer|min:0|max:999';
        $rules['number_two']         = 'required|integer|min:0|max:999';
        $rules['number_exercises']   = 'required|integer|min:5|max:50';

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
