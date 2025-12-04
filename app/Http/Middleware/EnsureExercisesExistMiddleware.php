<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureExercisesExistMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (! session()->has('exercises') || empty(session('exercises'))) {
            return redirect()
                ->route('home')
                ->with('error', 'No exercises generated yet.');
        }

        return $next($request);
    }
}
