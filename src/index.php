<?php

require_once __DIR__ . "/modules/person.php";

header("Content-Type: application/json");

$action = explode("/", $_SERVER["REQUEST_URI"])[1];

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
  default:
    echo json_encode(["error" => "Action not found"]);
    break;
}
