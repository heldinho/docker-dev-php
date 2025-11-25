<?php

require_once __DIR__ . "/db.php";

class Person {
  public static function getAllPersons() {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM persons");
    $stmt->execute();
    $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $persons;
  }

  public static function getPerson($id) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM persons WHERE id = :id");
    $stmt->execute(["id" => $id]);
    $person = $stmt->fetch(PDO::FETCH_ASSOC);
    return $person;

    return [
      "message" => "Person retrieved successfully",
      "data" => $person,
      "status" => "success",
    ];
  }

  public static function createPerson($body) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO persons (name, age, city, country, email, phone, address, zip) VALUES (:name, :age, :city, :country, :email, :phone, :address, :zip)");
    $stmt->execute([
      "name" => $body["name"],
      "age" => $body["age"],
      "city" => $body["city"],
      "country" => $body["country"],
      "email" => $body["email"],
      "phone" => $body["phone"],
      "address" => $body["address"],
      "zip" => $body["zip"],
    ]);
    return [
      "message" => "Person created successfully",
      "data" => $body,
      "status" => "success",
    ];
  }
}