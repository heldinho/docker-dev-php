<?php

require_once __DIR__ . "/db.php";

class User {
  public static function getAllUsers() {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  public static function getUser($id) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(["id" => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
      return [
        "message" => "User not found",
        "status" => "error",
      ];
    }

    return [
      "message" => "User retrieved successfully",
      "data" => $user,
      "status" => "success",
    ];
  }

  public static function createUser($body) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    // Validação básica
    if (empty($body["name"]) || empty($body["email"])) {
      return [
        "message" => "Name and email are required",
        "status" => "error",
      ];
    }

    try {
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, NOW())");
      $stmt->execute([
        "name" => $body["name"],
        "email" => $body["email"],
        "password" => isset($body["password"]) ? password_hash($body["password"], PASSWORD_DEFAULT) : null,
      ]);
      
      $userId = $conn->lastInsertId();
      
      return [
        "message" => "User created successfully",
        "data" => [
          "id" => $userId,
          "name" => $body["name"],
          "email" => $body["email"],
        ],
        "status" => "success",
      ];
    } catch (PDOException $e) {
      return [
        "message" => "Error creating user: " . $e->getMessage(),
        "status" => "error",
      ];
    }
  }

  public static function updateUser($id, $body) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    // Verifica se o usuário existe
    $user = self::getUser($id);
    if ($user["status"] === "error") {
      return $user;
    }

    try {
      $fields = [];
      $params = ["id" => $id];
      
      if (isset($body["name"])) {
        $fields[] = "name = :name";
        $params["name"] = $body["name"];
      }
      
      if (isset($body["email"])) {
        $fields[] = "email = :email";
        $params["email"] = $body["email"];
      }
      
      if (isset($body["password"])) {
        $fields[] = "password = :password";
        $params["password"] = password_hash($body["password"], PASSWORD_DEFAULT);
      }
      
      if (empty($fields)) {
        return [
          "message" => "No fields to update",
          "status" => "error",
        ];
      }
      
      $fields[] = "updated_at = NOW()";
      $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute($params);
      
      return [
        "message" => "User updated successfully",
        "data" => self::getUser($id)["data"],
        "status" => "success",
      ];
    } catch (PDOException $e) {
      return [
        "message" => "Error updating user: " . $e->getMessage(),
        "status" => "error",
      ];
    }
  }

  public static function deleteUser($id) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    // Verifica se o usuário existe
    $user = self::getUser($id);
    if ($user["status"] === "error") {
      return $user;
    }

    try {
      $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
      $stmt->execute(["id" => $id]);
      
      return [
        "message" => "User deleted successfully",
        "status" => "success",
      ];
    } catch (PDOException $e) {
      return [
        "message" => "Error deleting user: " . $e->getMessage(),
        "status" => "error",
      ];
    }
  }
}

