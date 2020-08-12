Object Oriented Programming Army Battle
=======================================

Presentation
------------
This project is a pure Oriented Object Programming.

It use :
- Interface
- Abstract
- Traits
- Composition
- Dependency Injection

Setup
-----

### 1) Database Setup

This project uses a small MySQL database. First, configure your database settings:

A) open `initdb.php` and modify the `$databaseUser` and `$databasePassword` variables.
Make sure the user has permissions to create a database!

B) To create and pre-populate your database, open your favorite terminal application
and run:

```bash
cd /path/to_the_project/resources
php initdb.php
```

### 2) Composer Autoload Setup

This project uses [Composer](https://getcomposer.org/) for autoloading.

A) Download Composer https://getcomposer.org/

B) Run `composer install`:

```bash
php composer.phar install
```

You should now have a `vendor/` directory!

### 3) Web Server Setup

Start the built-in web server:

```bash
cd /path/to_the_project
php -S localhost:8000
```
Press ctrl+c to stop the server.

Your new site is on :

    http://localhost:8000

