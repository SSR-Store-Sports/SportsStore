<?php

require __DIR__ . '/Router.php';
use Bramus\Router\Router;

$router = new Router();

include 'app/views/components/header/index.php';
include 'app/views/components/sidebar/index.php';

$router->mount("/auth", function () use ($router) {
  $router->get('/login', function () {
    require 'app/views/users/login/index.php';
  });

  $router->get('/register', function () {
    require 'app/views/users/register/index.php';
  });
});

$router->get('/', function () {
  require 'app/views/index.php';
});

$router->get('/check', function () {
  require 'app/views/users/check/index.php';
});

$router->get('/products', function () {
  require 'app/views/products/product/index.php';
});

$router->get('/cart', function () {
  require 'app/views/products/cart/index.php';
});

$router->get('/admin', function () {
  require 'app/views/users/admin/index.php';
});

$router->get('/configuracoes', function () {
  require 'app/views/users/configuration/index.php';
});

$router->get('/address', function () {
  require 'app/views/users/address/index.php';
});

$router->get('/follow-up', function () {
  require 'app/views/products/follow-up/index.php';
});

$router->get('/history', function () {
  require 'app/views/products/history/index.php';
});

$router->get('/product-selected', function () {
  require 'app/views/products/product-selected/index.php';
});

$router->set404(function () {
  require 'app/views/not-found/index.php';
});

$router->run();

include 'app/views/components/footer/index.php';
