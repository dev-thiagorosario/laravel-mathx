<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercises ({{ $appName }})</title>

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        hr {
            margin: 10px 0 20px;
        }

        .exercise {
            margin-bottom: 12px;
            font-size: 18px;
        }

        .exercise-number {
            font-weight: bold;
            margin-right: 8px;
        }

        @media print {
            body {
                margin: 10mm;
            }
        }
    </style>
</head>
<body>
<h1>Exercises ({{ $appName }})</h1>
<hr>

@foreach ($exercises as $exercise)
    <div class="exercise">
        <span class="exercise-number">
            {{ str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT) }})
        </span>

        {{ $exercise['exercise'] ?? '' }}
    </div>
@endforeach

<hr>

<h2>Solutions</h2>

@foreach ($exercises as $exercise)
    <div class="exercise">
        <span class="exercise-number">
            {{ str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT) }})
        </span>

        {{ $exercise['solution'] ?? '' }}
    </div>
@endforeach
</body>
</html>
