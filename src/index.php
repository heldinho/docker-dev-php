<?php
  header("Content-Type: application/json");

  $action = explode("/", $_SERVER["REQUEST_URI"])[1];
  $body = json_decode(file_get_contents("php://input"), true);


  function getPerson() {
    $name = "John Doe";
    $age = 20;
    $city = "New York";
    $country = "USA";
    $email = "john@example.com";
    $phone = "1234567890";
    $address = "123 Main Street, Anytown, USA";
    $zip = "12345";
  
    $data = [
      "nome" => $name,
      "idade" => $age,
      "cidade" => $city,
      "pais" => $country,
      "email" => $email,
      "telefone" => $phone,
      "endereco" => $address,
      "cep" => $zip,
    ];

    return $data;
  }

  function createPerson($body) {
    return [
      "message" => "Person created successfully",
      "data" => $body,
      "status" => "success",
    ];
  }


  switch ($action) {
    case "person":
      echo json_encode(getPerson(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      break;
    case "create-person":
      echo json_encode(createPerson($body), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      break;
    default:
      echo json_encode(["error" => "Action not found"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      break;
  }
?>

