<?php

require "Database.php";

class Login
{

  private $conn;

  public function __construct()
  {
    $this->conn = (new Database())->dbConnection();
  }

  public function login($email, $senha)
  {
    $stmt = $this->conn->prepare("SELECT * FROM account WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $acc = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($acc) {
      if (password_verify($acc['password'], $senha)) {
        session_start();
        $_SESSION['id'] = $acc['id'];
        $_SESSION['name'] = $acc['name'];
        // redirect - logado com sucesso
      } else {
        // redirect - senha não bate
      }
    } else {
      // redirect - conta não existe
    }
  }

  public function register($nome, $email, $senha)
  {
    $stmt = $this->conn->prepare("SELECT * FROM account WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $acc = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($acc) {
      // redirect - conta já existe
    } else {
      $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

      try {
        $stmt = $this->conn->prepare("INSERT INTO account (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(":name", $email);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $senhaHash);
        $stmt->execute();

        // redirect - registrado com sucesso
      } catch (PDOException $e) {
        // redirect - erro ao registrar
      }
    }
  }

  public function logout()
  {
    session_destroy();
    // redirect
  }
}
