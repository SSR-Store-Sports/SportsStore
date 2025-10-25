<?php

require __DIR__ . '/Router.php';
use Bramus\Router\Router;

$router = new Router();

$_ROUTER = $_SERVER["REQUEST_URI"];
include 'app/views/components/header/index.php';
include 'app/views/components/sidebar/index.php';

$router->get('/', function() {
  require 'app/views/index.php';
});

$router->get('/login', function() {
  require 'app/views/users/login/index.php';
});

$router->get('/register', function() {
  require 'app/views/users/register/index.php';
});

$router->get('/check', function() {
  require 'app/views/users/check/index.php';
});

$router->get('/products', function() {
  require 'app/views/products/product/index.php';
});

$router->get('/cart', function() {
  require 'app/views/products/cart/index.php';
});

$router->get('/admin', function() {
  require 'app/views/users/admin/index.php';
});

$router->set404(function() {
  require 'app/views/not-found/index.php';
});

$router->run();

include 'app/views/components/footer/index.php';
