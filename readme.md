



### Setup
---
Clone the repo and follow below steps.
1. Run `composer install`
2. Copy `.env.example` to `.env` Example for linux users : `cp .env.example .env`
3. Set valid database credentials of env variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`
4. Run `php artisan key:generate` to generate application key
5. Run `php artisan migrate`
6. Run `php artisan passport:install`
7. Run `php artisan db:seed` to seed your database
8. Run `npm i` (Recommended node version `>= V10.0`)
9. Run `npm run dev` or `npm run prod` as per your environment
10. create database `forge`
Thats it... Run the command `php artisan serve` and cheers, you are good to go with your new **articles adminpanal laravel** application.


### Demo Credentials
---
*Make sure you have run the command `php artisan db:seed --class UserTableSeeder` before you use these credentials.*

**User:** admin@admin.com\
**Password:** 1234
