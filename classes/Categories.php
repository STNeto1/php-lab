<?php

require "Database.php";

class Categories
{

  private $conn;

  public function __construct()
  {
    $this->conn = (new Database())->dbConnection();
  }

  public function insert($name)
  {
    $stmt = $this->conn->prepare("INSERT INTO categories (name) values (:name)");
    $stmt->bindParam(":name", $name);
    $stmt->execute();
  }

  public function fetchAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function fetchWithTotal()
  {
    $stmt = $this->conn->prepare("SELECT 
                                    c.id, c.name, count(p.name) AS total
                                  FROM
                                    products AS p
                                      LEFT JOIN
                                    categories AS c ON p.cat_id = c.id
                                  GROUP BY p.cat_id");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function fetchById($cid)
  {
    $stmt = $this->conn->prepare("SELECT 
                                      c.id as cat_id, c.name as cat_name, p.id as prod_id, p.name as prod_name, qty
                                  FROM
                                      categories AS c
                                          LEFT JOIN
                                      products AS p ON c.id = p.cat_id
                                  WHERE
                                      c.id = :cid");
    $stmt->bindParam(":cid", $cid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
