# Blog Site (PHP)

A web interface for a blog site, where can may register, sign in, view all blog entries, post new / edit existing / delete existing blog entry, add, edit and delete comments, and log out, done in Lavarel 9.

## To start

Download this repository, and place it on the server to use and update the .env file.

### Installation

Download vendor libraries with

```
composer update
```
create the .env file, add the variables you need, after that run the following command

```
php artisan key:generate
```

finally run the migrations

```
php artisan migrate
```
At the end make the necessary configurations in your environment to be able to run it

## Developed on

* [Laravel 10]
* [PHP 8]
* [HTML 5]
* [CSS 3]
* [Bootstrap 5]
* [jQuery]
* [VueJs]
