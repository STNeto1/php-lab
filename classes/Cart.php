<?php

session_start();

include_once "Routes.php";

class Cart
{

  public static function addToCart($id)
  {
    $jsonOb = array();

    if (isset($_SESSION['cart']))
      $jsonOb = json_decode($_SESSION['cart'], true);

    $jsonOb[] = $id;

    $_SESSION['cart'] = json_encode($jsonOb);
    Routes::redirect_to("/index.php?cart-success");
  }

  public static function getCartItems()
  {

    if (isset($_SESSION['cart']))
      return json_decode($_SESSION['cart']);
    return [];
  }

  public static function removeFromCart($id)
  {
    $items = self::getCartItems();

    $filtered_array = array_filter($items, function ($element) use ($id) {
      return ($element != $id);
    });

    if (count($filtered_array) > 0) {
      $_SESSION['cart'] = json_encode(array_values($filtered_array));
    } else {
      unset($_SESSION['cart']);
    }

    Routes::redirect_to("/cart.php?cart-remove-success");
  }
}
