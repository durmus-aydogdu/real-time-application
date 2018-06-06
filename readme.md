
##  Real time application example with Laravel / Redis / Socket.IO / Laravel-Echo 

Real time User Create/Update/Destroy example with Laravel / Redis / Socket.IO / Laravel-Echo 


## Installation

- Install redis server
- Run `composer install`
- Run `npm install`
- Run `npm install -g laravel-echo-server`
- Run `laravel-echo-server init`
- Run `npm run dev`
- Update `.env` file
- Run `php artisan key:generate` 
- Run `php artisan migrate` 
- Run `php artisan db:seed`

## Usage

- Run `php artisan queue:work`
- Run `laravel-echo-server start`
