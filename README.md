# MathX

MathX is a Laravel 12 application that helps teachers and parents create printable math exercises in seconds. You define the operations that should be practiced, configure the value range, choose how many questions you need, and MathX prepares a clean worksheet that can be exported, printed, or simply copied into your favorite LMS.

## Overview

- **Purpose** – streamline the creation of elementary arithmetic worksheets (addition, subtraction, multiplication, division) with full control over operands and the total number of problems generated.
- **Audience** – educators, tutors, and parents who need quick, configurable drills without maintaining complex spreadsheets.
- **UI** – responsive Bootstrap 5 layout with a single-page flow focused on data entry and worksheet preview.

## Features

- Toggle any combination of the four fundamental operations before generating exercises.
- Configure minimum and maximum operands (0–999) to match the current learning stage.
- Decide how many questions (5–50) should be generated in one batch.
- Dedicated endpoints reserved for future exporting (`/exportExercises`) and printing (`/printExercises`).
- Validation layer (`GenerateExercisesRequest`) ensures that at least one operation is selected and that operand ranges stay inside allowed bounds.

## Tech Stack

- [Laravel 12](https://laravel.com/) with PHP 8.2+
- Bootstrap 5 and custom CSS for layout (`public/assets/css/main.css`)
- Vite + Tailwind CSS (build pipeline) and Axios for potential HTTP integrations
- Composer for PHP dependencies and NPM for frontend tooling

## Prerequisites

- PHP 8.2 or newer with the `pcntl`, `openssl`, `pdo`, and `mbstring` extensions
- [Composer](https://getcomposer.org/)
- Node.js 20+ and npm 10+
- A running database compatible with Laravel (SQLite/MySQL/PostgreSQL); configure credentials in `.env`

## Getting Started

```bash
git clone https://github.com/<your-org>/mathx.git
cd mathx
cp .env.example .env                    # or use php -r "file_exists('.env') || copy(...)"
composer install
php artisan key:generate
php artisan migrate                     # adjust DB connection in .env first
npm install
npm run dev                             # or npm run build for production
php artisan serve
```

Visit `http://127.0.0.1:8000` and start configuring your worksheet.

> **Tip:** run `composer setup` to execute the full installation workflow (Composer, environment copy, key generation, migrations, npm install, Vite build) in one step.

## Useful Scripts

Command | Description
--- | ---
`composer setup` | Installs dependencies, creates `.env`, runs migrations, and builds assets.
`composer dev` | Starts Laravel (HTTP server, queue listener, logs) and Vite concurrently for local development.
`composer test` | Clears configuration cache and executes the application test suite.
`npm run dev` | Runs Vite in dev mode with hot module reloading.
`npm run build` | Produces the production asset bundle.

## Testing

```bash
php artisan test
```

Add or extend feature tests in `tests/Feature` as you implement the exercise generation workflow.

## Project Structure Highlights

- `routes/web.php` – HTTP routes (`/`, `/generateExercises`, `/printExercises`, `/exportExercises`).
- `app/Http/Controllers/MainController.php` – renders the landing page form.
- `app/Http/Controllers/GenerateExercisesController.php` – entry point for generating worksheets (extend with actual generation logic).
- `app/Http/Requests/GenerateExercisesRequest.php` – request validation rules.
- `resources/views/home.blade.php` – Bootstrap layout for user input.

## Deployment

1. Run `npm run build` to generate static assets.
2. Configure environment variables for production (database, cache, queue driver, `APP_URL`, etc.).
3. Cache configuration and routes for performance: `php artisan config:cache && php artisan route:cache`.
4. Use a process manager (Supervisor, systemd) or queue worker for long-running jobs when the generation logic involves asynchronous tasks.

## Contributing

1. Fork the repository and create a feature branch (`git checkout -b feature/improve-generation`).
2. Apply your changes and cover them with tests.
3. Run `composer test` and fix any reported issues.
4. Submit a pull request describing the updates and the motivation behind them.

## License

This project is open source under the [MIT license](https://opensource.org/licenses/MIT).
