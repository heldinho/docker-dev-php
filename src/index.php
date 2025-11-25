<?php

require_once __DIR__ . "/modules/person.php";

header("Content-Type: application/json");

$action = explode("/", $_SERVER["REQUEST_URI"])[1];
$body = json_decode(file_get_contents("php://input"), true);
$id = explode("/", $_SERVER["REQUEST_URI"])[2];

switch ($action) {
  case "persons":
    echo json_encode(Person::getAllPersons(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    break;
  case "person":
    echo json_encode(Person::getPerson($id), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    break;
  case "create-person":
    echo json_encode(Person::createPerson($body), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    break;
  default:
    echo json_encode(["error" => "Action not found"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    break;
}
