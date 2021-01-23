<?php

session_start();

include "includes/header.php";

include_once "classes/Cart.php";
include_once "classes/Product.php";


$obProduct = new Product();

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
// exit;

if (isset($_SESSION['cart'])) {
  $products = $obProduct->fetchByManyIds(Cart::getCartItems());
}





?>

<div class="container m-5">
  <table class="table table-striped">
    <thead>
      <th>ID</th>
      <th>Title</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Remove from cart</th>
    </thead>
    <tbody>
      <?php foreach ($products as $prod) : ?>
        <tr>
          <td><?= $prod['id'] ?></td>
          <td><?= $prod['title'] ?></td>
          <td><?= $prod['price'] ?></td>
          <td><?= $prod['quantity'] ?></td>
          <td>
            <form action="classes/Routes.php" method="get">
              <input type="hidden" name="remove_from_cart">
              <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
              <button type="submit" class="btn btn-sm btn-danger">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>