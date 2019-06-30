# 25572. Test Assignment for Laravel _ Frontend 

https://app.codeline.io/#/projects/2760/tasks/25572

The task's backend is built with **Laravel 5.7** using PHP version **7.1.3** and the frontend with **Angular 7**.

To install backend dependencies, run **composer install** in the root directory. Afterwards, set up the database values in the .env file and then run migration using **php artisan migrate**.
To seed the database, run **php artisan db:seed**

To install frontend dependencies, run **npm i** from the **frontend** directory. The base url for API calls is stored in src/environments/environment.ts file. Please change it to reflect the backend's url and port.

This task uses **clean code** by employing *request - validation - controller - service - repo - model* at the backend where possible and *repository pattern(cache before network)* at the frontend. Both backend and frontend rely heavily on dependency injection. 

I used RxJS for some part of the frontend