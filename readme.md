



### Setup
---
Clone the repo and follow below steps.
1. Run `composer install`
2. Set valid database credentials of env variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`
3. Run `php artisan key:generate` to generate application key
4. Run `php artisan migrate`
5. Run `php artisan passport:install`
6. Run `php artisan db:seed` to seed your database
7. Run `npm i` (Recommended node version `>= V10.0`)
8. Run `npm run dev` or `npm run prod` as per your environment
9. create database `forge`
Thats it... Run the command `php artisan serve` and cheers, you are good to go with your new **articles adminpanal laravel** application.


### Demo Credentials
---
*Make sure you have run the command `php artisan db:seed --class UserTableSeeder` before you use these credentials.*

**User:** admin@admin.com\
**Password:** 1234
