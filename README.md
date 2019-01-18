# zoefin
Finds the closest users to a selected Agent using their zip code data.

# Requirements
* PHP >= 7.2.0 (also meet the server requirements of the laravel installation [guide](https://laravel.com/docs/5.7/installation))
* Apache >= 2.4 (mod_rewrite enabled)
* MySQL >= 5.7
* Composer >= 1.7.2

# Installation
* Once cloned the repository, inside the project directory type `composer install`
* Type `composer update`
* Copy .env.example to .env
* Type `php artisan key:generate`to regenerate secure key
* In *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
   * set GOOGLE_MAPS_API_KEY
* Type `php artisan migrate --seed` to create and populate tables
You can create a symbolic link to the public directory or access it directly.
