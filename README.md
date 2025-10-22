# Simple Laravel Elasticsearch App — Product Catalog with Search

A Laravel 12 application that showcases a simple product catalog with search and filtering. Products can be browsed publicly, and authenticated users get CRUD routes for managing products. Full-text and filtered search are powered by Laravel Scout, with Elasticsearch integration provided via the jeroen-g/explorer package.

This README documents the stack, requirements, setup, scripts, environment, tests, and project structure. Updated on: 2025-10-22 13:54 local time.

## Overview

- Public catalog at /products with category, brand, and price range filters.
- Search implemented using Laravel Scout. When configured with Explorer + Elasticsearch, price range filters are applied server-side using range queries.
- Basic authentication routes exist; access to admin CRUD routes is behind auth middleware.
- Seeders provide sample product data for quick bootstrapping.

## Tech Stack

Backend
- PHP 8.2+
- Laravel 12
- Laravel Scout
- jeroen-g/explorer (Elasticsearch integration for Scout)
- Database: MySQL by default (tests use in-memory SQLite)

Frontend
- Vite 7
- Tailwind CSS 3
- Alpine.js

Tooling
- Composer
- Node.js + npm
- PHPUnit 11

## Requirements

- PHP >= 8.2 with required PHP extensions for Laravel
- Composer
- Node.js >= 18 and npm
- Database (default: MySQL). Tests use SQLite in memory.
- Optional: Elasticsearch (for Explorer integration)
- Optional: Redis/Memcached, etc. depending on chosen cache/queue drivers

## Quick Start

1) Clone and install dependencies
- composer install
- npm install

2) Configure environment
- cp .env.example .env
- Set DB_ credentials in .env (defaults use MySQL)
- php artisan key:generate

3) Migrate and seed
- php artisan migrate
- php artisan db:seed --class=Database\\Seeders\\ProductSeeder

4) (Optional) Build search index
- By default, Scout driver is "collection" (in-memory). To use Elasticsearch via Explorer, set SCOUT_DRIVER and Explorer env vars below, then import:
  - php artisan scout:import "App\\Models\\Product"

5) Run the app
- Option A (recommended, concurrent): composer run dev
  - This runs: php artisan serve + queue listener + logs + npm run dev
- Option B (manual):
  - php artisan serve
  - npm run dev

6) Open in browser
- http://127.0.0.1:8000 → redirects to /products

## Scripts

Composer scripts (composer.json)
- composer run setup
  - composer install
  - copies .env if missing and generates APP_KEY
  - php artisan migrate --force
  - npm install
  - npm run build
- composer run dev
  - Runs concurrently: php artisan serve, queue:listen, pail (logs), and npm run dev
- composer run test
  - Clears config cache then runs php artisan test

npm scripts (package.json)
- npm run dev → vite
- npm run build → vite build

## Environment Variables
Base (.env.example)
- APP_NAME, APP_ENV, APP_KEY, APP_DEBUG, APP_URL
- Locale: APP_LOCALE, APP_FALLBACK_LOCALE, APP_FAKER_LOCALE
- Logging: LOG_CHANNEL, LOG_STACK, LOG_LEVEL
- DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
- SESSION_DRIVER, SESSION_LIFETIME, SESSION_ENCRYPT, SESSION_PATH, SESSION_DOMAIN
- BROADCAST_CONNECTION, FILESYSTEM_DISK, QUEUE_CONNECTION
- CACHE_STORE, CACHE_PREFIX
- REDIS_CLIENT, REDIS_HOST, REDIS_PASSWORD, REDIS_PORT
- MAIL_* (MAIL_MAILER, etc.)
- VITE_APP_NAME

Scout (config/scout.php)
- SCOUT_DRIVER (defaults to collection)
- SCOUT_PREFIX (optional)
- SCOUT_QUEUE (true/false)
- For specific engines (only needed if you switch):
  - Algolia: ALGOLIA_APP_ID, ALGOLIA_SECRET
  - Meilisearch: MEILISEARCH_HOST, MEILISEARCH_KEY
  - Typesense: TYPESENSE_* (API/key/nodes)

Explorer / Elasticsearch (config/explorer.php)
- ELASTICSEARCH_HOST (default: localhost)
- ELASTICSEARCH_PORT (default: 9200)
- ELASTICSEARCH_SCHEME (default: http)
- ELASTICSEARCH_USER (optional)
- ELASTICSEARCH_PASS (optional)
- EXPLORER_ELASTIC_LOGGER_ENABLED (default: false)

Queues and Logs
- QUEUE_CONNECTION is set to "database" by default in .env.example. Ensure queue tables are migrated if you use database queues: php artisan queue:table && php artisan migrate.

## Running Tests
- composer run test
- or: php artisan test

Notes
- phpunit.xml config uses an in-memory SQLite database for tests. No extra DB setup is required when running tests.

## Project Structure
- app/
  - Models/Product.php (Laravel Scout + Explorer index mapping)
  - Http/Controllers/ProductController.php (catalog + CRUD actions)
  - Services/ProductService.php (filtering/search orchestration)
  - Repositories/ProductRepository.php, ProductRepositoryInterface (data access and search)
- database/
  - migrations/ (tables)
  - seeders/ProductSeeder.php (sample products)
- routes/
  - web.php (routes for /products and admin CRUD under auth)
- resources/
  - views/ (Blade templates)
  - css/js (Vite + Tailwind + Alpine)
- public/
  - index.php (HTTP entry point)

Entry points
- HTTP: public/index.php (served via php artisan serve or web server)
- Console: artisan

## Data and Search
- Seeding: php artisan db:seed --class=Database\\Seeders\\ProductSeeder
- Scout driver defaults to "collection". For Elasticsearch, configure Explorer env vars and set SCOUT_DRIVER accordingly, then run:
  - php artisan scout:import "App\\Models\\Product"

## Routes
- GET / → redirects to /products
- GET /products → product index with filters
- GET /products/{product} → product details
- Authenticated routes under /admin/products for create/edit/update/delete

## License
This project is licensed under the MIT license (see composer.json).

## TODOs
- CI status badge and deployment instructions.
- Production configuration for queues, cache, and session drivers.
- Document Elasticsearch provisioning and secured connection details.
- Auth scaffolding UI: routes exist; if UI is desired, install and document Laravel Breeze or other starter.
- Docker/Sail: laravel/sail is available as a dev dependency but not configured here; add instructions if used.
