<?php

require __DIR__ . '/Router.php';
use Bramus\Router\Router;

$router = new Router();

include 'app/views/_components/header/index.php';
include 'app/views/_components/sidebar/index.php';

$router->mount("/auth", function () use ($router) {
  $router->get('/login', function () {
    require 'app/views/users/login/index.php';
  });

  $router->get('/registro', function () {
    require 'app/views/users/register/index.php';
  });
});

$router->get('/', function () {
  require 'app/views/index.php';
});

$router->get('/check', function () {
  require 'app/views/users/check/index.php';
});

$router->get('/produtos', function () {
  require 'app/views/products/product/index.php';
});

$router->get('/carrinho', function () {
  require 'app/views/products/cart/index.php';
});

$router->mount("/admin", function () use ($router) {
  $router->get('/', function () {
    require 'app/views/admin/index.php';
  });

  $router->get('/produtos', function () {
    require 'app/views/admin/products/index.php';
  });
});

$router->get('/configuracoes', function () {
  require 'app/views/users/configuration/index.php';
});

$router->get('/endereco', function () {
  require 'app/views/users/address/index.php';
});

$router->get('/acompanhamento', function () {
  require 'app/views/products/follow-up/index.php';
});

$router->get('/historico', function () {
  require 'app/views/products/history/index.php';
});

$router->get('/produto-selecionado', function () {
  require 'app/views/products/product-selected/index.php';
});

$router->set404(function () {
  require 'app/views/not-found/index.php';
});

$router->run();

include 'app/views/_components/footer/index.php';
