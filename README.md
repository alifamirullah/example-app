# Example Laravel App

This is a Laravel 10+ starter application.

## Requirements

Make sure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL or other supported database
- Node.js and npm (for frontend assets)
- Git

## Installation

1. **Clone the Repository**
git clone https://github.com/alifamirullah/example-app.git
cd example-app

2. **Install Composer Dependencies**
composer install

3. **Copy the Environment File**
cp .env.example .env

4. **Generate the Application Key**
php artisan key:generate

5. **Set Up Your Environment**
- Edit .env and configure your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=example_db
DB_USERNAME=root
DB_PASSWORD=

6. **Run Migrations**
php artisan migrate

7. **Install Frontend Dependencies**
npm install
npm run dev

8. **Run the Laravel Development Server**
php artisan serve

9. **Visit http://localhost:8000 to view the application.**

## Optional

1. **Run Database Seeder (if you add any):**
php artisan db:seed

2. **Clear Cache (if needed):**
php artisan config:clear
php artisan cache:clear
php artisan route:clear

3. **Testing**
Run the test suite with:
php artisan test

## License
This project is open-source and free to use under the MIT license.
