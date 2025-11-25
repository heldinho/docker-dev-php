<?php
header("Content-Type: application/json");

$action = explode("/", $_SERVER["REQUEST_URI"])[1];

// Rota para documentação Swagger
if ($action === "docs" || $action === "swagger") {
    header("Content-Type: text/html; charset=UTF-8");
    readfile(__DIR__ . "/docs.html");
    exit;
}

// Rotas da API
require_once __DIR__ . "/modules/person.php";
require_once __DIR__ . "/modules/user.php";


switch ($action) {
  case "persons":
    echo json_encode(Person::getAllPersons());
    break;
  case "person":
    $id = explode("/", $_SERVER["REQUEST_URI"])[2];
    echo json_encode(Person::getPerson($id));
    break;
  case "create-person":
    $body = json_decode(file_get_contents("php://input"), true);
    echo json_encode(Person::createPerson($body));
    break;
  case "users":
    echo json_encode(User::getAllUsers());
    break;
  case "user":
    $id = explode("/", $_SERVER["REQUEST_URI"])[2] ?? null;
    echo json_encode(User::getUser($id));
    break;
  case "create-user":
    $body = json_decode(file_get_contents("php://input"), true);
    echo json_encode(User::createUser($body ?? []));
    break;
  case "update-user":
    $id = explode("/", $_SERVER["REQUEST_URI"])[2] ?? null;
    $body = json_decode(file_get_contents("php://input"), true);
    echo json_encode(User::updateUser($id, $body ?? []));
    break;
  case "delete-user":
    $id = explode("/", $_SERVER["REQUEST_URI"])[2] ?? null;
    echo json_encode(User::deleteUser($id));
    break;
  default:
    echo json_encode(["error" => "Action not found"]);
    break;
}
