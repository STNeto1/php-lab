<?php

class Database
{
  private string $host = "localhost";
  private string $dbName = "lab";
  private string $username = "stneto";
  private string $password = "neto";

  public PDO $conn;

  public function dbConnection(): PDO
  {
    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
