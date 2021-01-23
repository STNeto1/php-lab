<?php

require "Database.php";

class Admin
{

  private $conn;

  public function __construct()
  {
    $this->conn = (new Database())->dbConnection();
  }

  // future admin stuff

}
