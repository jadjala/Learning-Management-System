# Simple LMS

## Elevator pitch
A lightweight Laravel-based LMS where instructors manage courses and students learn efficiently online.

## Tech stack
- PHP 8.x (Laravel 10)  
- MySQL / MariaDB  
- Blade templates  
- Tailwind CSS (via CDN)  
- Git for version control  

## Run instructions
1. Clone repo: `git clone <repo-url>`  
2. Install dependencies: `composer install`  
3. Copy `.env.example` to `.env` and set database credentials  
4. Generate key: `php artisan key:generate`  
5. Run migrations & seed: `php artisan migrate --seed`  
6. Serve locally: `php artisan serve` (default: http://127.0.0.1:8000)  

## Adding new features / maintenance
- Add controllers via `php artisan make:controller NameController`  
- Create migrations via `php artisan make:migration`  
- Views go in `resources/views`  
- Middleware protects role-specific routes  

## License
MIT