# Laravel EcomerceShop

> Laravel Ecomerce Shop. 

E-Commerce Project
This is a e-commerce project built with the Laravel framework. It includes features such as:

- Product listings
- Shopping cart
- Checkout with Stripe payment integration
- Order history
- Admin panel for managing products, orders, Categories, sub Categories etc. 
- Admin Panel for managing Website's configuration
- Spanish and English Available.



This project runs with Laravel version 8.0.

## Getting started

Assuming you've already installed on your machine: PHP (>= 7.0.0), [Laravel](https://laravel.com), [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org).

``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate

# build CSS and JS assets
npm run dev
# or, if you prefer minified files
npm run prod
```

Then launch the server:

``` bash
php artisan serve
```

The Laravel sample project is now up and running! Access it at http://localhost:8000.
