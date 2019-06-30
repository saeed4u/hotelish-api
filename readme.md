The task's backend is built with **Laravel 5.7** using PHP version **7.1.3**.

To install backend dependencies, run **composer install** in the root directory. Afterwards, set up the database values in the .env file and then run migration using **php artisan migrate**.
To seed the database, run **php artisan db:seed**

This task uses **clean code** by employing *request - validation - controller - service - repo - model* at the backend where possible. I utilised Laravel's dependency injection.

