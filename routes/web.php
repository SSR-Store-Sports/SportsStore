<?php

$_ROUTER = $_SERVER["REQUEST_URI"];

switch ($_ROUTER) {
  case "/":
    require 'app/views/home-page.php';
    break;
  case "/login":
    require 'app/views/users/login/login-page.php';
    break;
  case "/register":
    require 'app/views/users/register/register-page.php';
    break;
  case "/products":
    require 'app/views/products/products-page.php';
    break;
  case "/cart":
    require 'app/views/products/cart-page.php';
    break;
  default:
    require 'app/views/not-found-page.php';
    break;
};

?>