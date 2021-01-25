<?php

require "Database.php";

class Product
{

  private $conn;

  public function __construct()
  {
    $this->conn = (new Database())->dbConnection();
  }

  public function insert($name, $qty, $cat_id)
  {
    $stmt = $this->conn->prepare("INSERT INTO products (name, qty, cat_id) VALUES (:name, :qty, :cat_id)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":qty", $qty);
    $stmt->bindParam(":cat_id", $cat_id);
    $stmt->execute();
  }

  public function fetchAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function fetchById($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
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

  public function fetchAllWithCategories()
  {
    $stmt = $this->conn->prepare("SELECT 
                                    p.id AS prod_id,
                                    p.name AS prod_name,
                                    p.qty,
                                    p.cat_id,
                                    c.name as cat_name
                                  FROM
                                    products AS p
                                        LEFT JOIN
                                    categories AS c ON p.cat_id = c.id;");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // update (nah)
  // delete (nah)


}
