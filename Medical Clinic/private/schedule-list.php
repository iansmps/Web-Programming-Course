<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

session_start();
$mysqli = connect();
checkLoggedUserOrDie($mysqli);
?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

  <link href="css/index.css" rel="stylesheet">
</head>

<body>
  <div id="wrapper" class="toggled">
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a href="index.php">
            Clínica do Povo
          </a>
        </li>
        <hr>
        <li>
          <a href="employee-register.php">Novo funcionário</a>
        </li>
        <li>
          <a href="employee-list.php">Listar funcionários</a>
        </li>
        <li>
          <a href="contact-list.php">Listar contatos</a>
        </li>
        <li>
          <a href="schedule-list.php">Listar Agendamentos</a>
        </li>
      </ul>
    </div>


    <div id="page-content-wrapper">
      <div class="container-fluid py-5">
        <h1>Listar agendamentos</h1>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nº</th>
              <th scope="col">Médico</th>
              <th scope="col">Especialidade</th>
              <th scope="col">Data</th>
              <th scope="col">Hora</th>
              <th scope="col">Paciente</th>
              <th scope="col">Telefone</th>
            </tr>
          </thead>
          <tbody>

			<?php
            $query = $mysqli->query("SELECT *, FUNCIONARIO.NOME AS MEDICO FROM AGENDA INNER JOIN FUNCIONARIO ON AGENDA.FK_MEDICO = FUNCIONARIO.ID INNER JOIN PACIENTE ON AGENDA.FK_PACIENTE = PACIENTE.ID ORDER BY FUNCIONARIO.NOME, DATA_AGENDAMENTO");

            while ($row = $query->fetch_assoc()) {
              echo "<tr>";
              echo "<th scope='row'>".$row[ID]."</th>";
              echo "<td>".$row[MEDICO]."</td>";
              echo "<td>".$row[ESPECIALIDADE_MEDICA]."</td>";
              echo "<td>".$row[DATA_AGENDAMENTO]."</td>";
              echo "<td>".$row[HORA_AGENDAMENTO]."</td>";
              echo "<td>".$row[NOME]."</td>";
              echo "<td>".$row[TELEFONE]."</td>";
              echo "</tr>";
          }
          ?>   
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

</body>

</html>