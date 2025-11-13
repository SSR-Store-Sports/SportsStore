<?php

require __DIR__ . '/utils/Bramus/Router.php';

use Bramus\Router\Router;

$router = new Router();
$locationCurrent = __DIR__;

include $locationCurrent . './views/_components/header/index.php';
include $locationCurrent . './views/_components/sidebar/index.php';

// $router->mount("/auth", function () use ($router) {
//   $router->get('/login', function () {
//     require '/views/users/login/index.php';
//   });

//   $router->get('/registro', function () {
//     require '/views/users/register/index.php';
//   });
// });

$router->get('/', function () {
  global $locationCurrent;
  $path = strval($locationCurrent) . './views/index.php';
  require $path;
});

// $router->get('/check', function () {
//   require '/views/users/check/index.php';
// });

// $router->get('/produtos', function () {
//   require '/views/products/product/index.php';
// });

// $router->get('/carrinho', function () {
//   require '/views/products/cart/index.php';
// });

// $router->mount("/admin", function () use ($router) {
//   $router->get('/', function () {
//     require '/views/admin/index.php';
//   });

//   $router->get('/produtos', function () {
//     require '/views/admin/products/index.php';
//   });
// });

// $router->get('/configuracoes', function () {
//   require '/views/users/configuration/index.php';
// });

// $router->get('/endereco', function () {
//   require '/views/users/address/index.php';
// });

// $router->get('/acompanhamento', function () {
//   require '/views/products/follow-up/index.php';
// });

// $router->get('/historico', function () {
//   require '/views/products/history/index.php';
// });

// $router->get('/produto-selecionado', function () {
//   require '/views/products/product-selected/index.php';
// });

// $router->set404(function () {
//   require '/views/not-found/index.php';
// });

$router->run();

include $locationCurrent . './views/_components/footer/index.php';
