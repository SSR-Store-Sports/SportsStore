<?php

$_ROUTER = $_SERVER["REQUEST_URI"];
include 'app/views/components/header/index.php';
include 'app/views/components/sidebar/index.php';

switch ($_ROUTER) {
  case "/":
    require 'app/views/index.php';
    break;
  case "/login":
    require 'app/views/users/login/index.php';
    break;
  case "/register":
    require 'app/views/users/register/index.php';
    break;
  case "/check":
    require 'app/views/users/check/index.php';
    break;
  case "/admin":
    require 'app/views/users/admin/index.php';
    break;  
  case "/products":
    require 'app/views/products/product/index.php';
    break;
  case "/cart":
    require 'app/views/products/cart/index.php';
    break;
  default:
    require 'app/views/not-found/index.php';
    break;
};

include 'app/views/components/footer/index.php';
