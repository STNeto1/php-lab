<?php

session_start();

// require das classes
require_once "Product.php";
require_once "Cart.php";

class Routes
{

  public static function redirect_to($path)
  {
    header("location: $path");
    exit;
  }

  public static function is_logged()
  {
    if (!isset($_SESSION['id'])) {
      self::redirect_to("login.php?auth-required");
    }
  }

  public static function is_admin()
  {
    if (!isset($_SESSION['id'], $_SESSION['is_admin']) && !$_SESSION['is_admin']) {
      self::redirect_to("login.php?not-admin");
    }
  }
}



if (isset($_POST['add_to_cart'])) {
  if (isset($_POST['product_id'])) {
    Cart::addToCart($_POST['product_id']);
  } else {
    Routes::redirect_to("/index.php?cart-invalid-item");
  }
}

if (isset($_GET['remove_from_cart'])) {
  if (isset($_GET['product_id'])) {
    Cart::removeFromCart($_GET['product_id']);
  } else {
    Routes::redirect_to("/cart.php?cart-invalid-item");
  }
}
