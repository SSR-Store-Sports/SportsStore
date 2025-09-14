<?php

$_ROUTER = $_SERVER["REQUEST_URI"];
include 'app/views/components/header/index.php';

switch ($_ROUTER) {
  case "/":
    require 'app/views/home.php';
    break;
  case "/login":
    require 'app/views/users/login/index.php';
    break;
  case "/register":
    require 'app/views/users/register/index.php';
    break;
  case "/products":
    require 'app/views/products/products-page.php';
    break;
  case "/cart":
    require 'app/views/products/cart-page.php';
    break;
  default:
    require 'app/views/not-found.php';
    break;
};

include 'app/views/components/footer/index.php';

?>