<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

$mysqli = connect();

if($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["data"] && $_GET["doutor"]) {

  $doctor = $_GET["doutor"];
  $data = $_GET["data"];
  $mysqli = connect();
  $stmt = $mysqli->prepare("SELECT HORA_AGENDAMENTO FROM AGENDA WHERE FK_MEDICO = ?  AND DATA_AGENDAMENTO = ?");
  $stmt->bind_param("ss", $doctor, $data);

  if (!$stmt->execute())
    echo "Falha: (" . $stmt->errno . ") " . $stmt->error;
  else {
    $stmt->bind_result($hour);
    while ($row = $stmt->fetch()) {
      $response[] = $hour;
    }
    echo json_encode($response);
  }
}
?>