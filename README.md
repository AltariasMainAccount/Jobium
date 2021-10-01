# Jobium - Website for Job Listings

## Description
This was supposed to be a full on website for managing job listings but since it was bigger than I expected it is mostly backend with little to no frontend.
It uses Laravel 8.16.1 (the latest stable version), with SCSS (Sass Compilation) and Bootstrap 4 (in form of an NPM Module, not imported into the html files).

## API Authorization

API Authorization is done using Policies and auth:sanctum (Laravel Sanctum).
This Authorization is a budget version since there was little to no time left to actually bother with making sure the user cannot delete other users or models that they have no business touching.

Permissions are as follows:
- namespace (either user, job or company)
- permlevel (either view, update, create or all)

Together one of these permissions would be `user:all` or `job:update`
The permissions are attached to a token that is generated during login or registration.
You can also generate custom tokens using the route `api/newToken` with a post request.

To access the API in any way, you have to put the Token you recieve after logging in into the header of your request.
This would be a bearer token.

## License

The project is licensed under the same license as the Laravel framework itself, which is the [MIT license](https://opensource.org/licenses/MIT).

## Installation

```
# cd into the project directory
composer install
composer dumpautoload -o
# create "database.sqlite" file in the folder "database"
php artisan migrate:fresh (Will migrate the database)
php artisan db:seed (will create a dummy database using seeders and factories)
php artisan config:cache

# after all that
php artisan serve (will open the Development server)
```

## Database Info

The database is a sqlite3 database.
To migrate to it all you need to do is create the `database.sqlite` file in the folder `database`.
After that you can simply use it.

Since there is migrations set up, you can also use other database systems (for example MySQL).

## Routes
Retrieved from php artisan route:list
```
+--------+-----------+----------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method    | URI                        | Name            | Action                                                     | Middleware                               |
+--------+-----------+----------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD  | /                          | /               | Closure                                                    | web                                      |
|        | POST      | api/adminToken             |                 | App\Http\Controllers\AuthController@adminToken             | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/company                | company.index   | App\Http\Controllers\CompanyController@index               | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/company                | company.store   | App\Http\Controllers\CompanyController@store               | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/company/create         | company.create  | App\Http\Controllers\CompanyController@create              | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE    | api/company/{company}      | company.destroy | App\Http\Controllers\CompanyController@destroy             | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT|PATCH | api/company/{company}      | company.update  | App\Http\Controllers\CompanyController@update              | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/company/{company}      | company.show    | App\Http\Controllers\CompanyController@show                | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/company/{company}/edit | company.edit    | App\Http\Controllers\CompanyController@edit                | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/job                    | job.index       | App\Http\Controllers\JobController@index                   | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/job                    | job.store       | App\Http\Controllers\JobController@store                   | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/job/create             | job.create      | App\Http\Controllers\JobController@create                  | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE    | api/job/{job}              | job.destroy     | App\Http\Controllers\JobController@destroy                 | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT|PATCH | api/job/{job}              | job.update      | App\Http\Controllers\JobController@update                  | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/job/{job}              | job.show        | App\Http\Controllers\JobController@show                    | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/job/{job}/edit         | job.edit        | App\Http\Controllers\JobController@edit                    | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/login                  |                 | App\Http\Controllers\AuthController@login                  | api                                      |
|        | POST      | api/logout                 |                 | App\Http\Controllers\AuthController@logout                 | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/me                     |                 | App\Http\Controllers\AuthController@checkMyself            | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/newToken               |                 | App\Http\Controllers\AuthController@newToken               | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/register               |                 | App\Http\Controllers\AuthController@register               | api                                      |
|        | POST      | api/user                   | user.store      | App\Http\Controllers\UserController@store                  | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/user                   |                 | Closure                                                    | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/user/create            | user.create     | App\Http\Controllers\UserController@create                 | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT|PATCH | api/user/{user}            | user.update     | App\Http\Controllers\UserController@update                 | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE    | api/user/{user}            | user.destroy    | App\Http\Controllers\UserController@destroy                | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/user/{user}            | user.show       | App\Http\Controllers\UserController@show                   | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/user/{user}/edit       | user.edit       | App\Http\Controllers\UserController@edit                   | api                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | dashboard                  | dashboard       | Closure                                                    | web                                      |
|        |           |                            |                 |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | login-page                 | login-page      | Closure                                                    | web                                      |
|        | GET|HEAD  | register-page              | register-page   | Closure                                                    | web                                      |
|        | GET|HEAD  | sanctum/csrf-cookie        |                 | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+-----------+----------------------------+-----------------+------------------------------------------------------------+------------------------------------------+
```

## Tests

The tests that have been done were mainly done using phpunit (php artisan test).
The only notable file is `DatabaseTest.php` in the `tests/Feature` folder.
This will test all the relations, if the database was properly set up and if the program can create the models.

## Frontend

Since there was not much time left after I had done the backend, I've decided to just stick to a simplistic frontend.
