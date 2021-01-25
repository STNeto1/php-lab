<?php
session_start();

include "includes/header.php";

// include de classes
// include "classes/Routes.php";
require_once "classes/Product.php";

// (new Routes())->is_logged();

// instâncias de classes
$obProduct = new Product();


$products = $obProduct->fetchAllWithCategories();


?>

<div class="container m-5">
  <table class="table table-striped">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Category</th>
      <!-- <th>Add to Cart</th> -->
    </thead>
    <tbody>
      <?php foreach ($products as $prod) : ?>
        <tr>
          <td><?= $prod['prod_id'] ?></td>
          <td><?= $prod['prod_name'] ?></td>
          <td><?= $prod['qty'] ?></td>
          <td>
            <a href="category.php?cid=<?= $prod['cat_id'] ?>">
              <?= $prod['cat_name'] ?>
            </a>
          </td>
          <!-- <td>
            <form action="classes/Routes.php" method="post">
              <input type="hidden" name="add_to_cart">
              <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
              <button type="submit" class="btn btn-sm btn-success">Add</button>
            </form>
          </td> -->
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>