<?php

include "includes/header.php";

// include de classes
// include "classes/Routes.php";
require_once "classes/Categories.php";

$obCategory = new Categories();

$category = $obCategory->fetchById($_GET['cid']);

echo "<pre>";
print_r($category);
echo "</pre>";
exit;
