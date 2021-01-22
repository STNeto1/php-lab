<?php

require "Database.php";

class Product
{

  private $conn;

  public function __construct()
  {
    $this->conn = (new Database())->dbConnection();
  }

  public function insert($title, $price, $qty)
  {
    $stmt = $this->conn->prepare("INSERT INTO product (title, price, qty) VALUES (:title, :price, :qty)");
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":price", $$price);
    $stmt->bindParam(":qty", $qty);
    $stmt->execute();
  }

  public function fetchAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM product");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function fetchById($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


  public function fetchByManyIds($ids)
  {
    $in  = str_repeat('?,', count($ids) - 1) . '?';

    $stmt = $this->conn->prepare("SELECT * FROM product WHERE id in ($in)");
    $stmt->execute($ids);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // update (nah)
  // delete (nah)


}
