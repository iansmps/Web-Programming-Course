<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

$mysqli = connect();

if($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["especialidade"]) {

  $especiality = $_GET["especialidade"];
  $mysqli = connect();
  $stmt = $mysqli->prepare("SELECT ID, NOME FROM FUNCIONARIO WHERE ESPECIALIDADE_MEDICA = ? ");
  $stmt->bind_param("s", $especiality);

  if (!$stmt->execute())
    echo "Falha: (" . $stmt->errno . ") " . $stmt->error;
  else {
    $stmt->bind_result($id, $name);
    while ($row = $stmt->fetch()) {
      $response[] = array('id' => $id, 'name' => $name);
    }
    echo json_encode($response);
  }
}
?>