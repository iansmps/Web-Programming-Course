<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $especiality = validateUserInput($_POST['especiality']);
  $doctor = validateUserInput($_POST['doctor']);
  $date = validateUserInput($_POST['date']);
  $hour = validateUserInput($_POST['hour']);
  $name = validateUserInput($_POST['name']);
  $phone = validateUserInput($_POST['phone']);
  
  $mysqli = connect();
  echo $mysqli->connect_error;

try
{
    $mysqli->begin_transaction();
    $stmt = $mysqli->prepare("INSERT INTO PACIENTE (NOME, TELEFONE) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $phone);
    
    if (!$stmt->execute())
      throw new Exception('Erro ao inserir na tabela Paciente');

    $last_id = $stmt->insert_id;
    $stmt = $mysqli->prepare("INSERT INTO AGENDA (DATA_AGENDAMENTO, HORA_AGENDAMENTO, FK_MEDICO, FK_PACIENTE) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $date, $hour, $doctor, $last_id);
      
    if(!$stmt->execute())
      throw new Exception('Erro ao inserir na tabela Agenda');

    $mysqli->commit();
       echo "<div class='alert alert-success alert-dismissible'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Cadastro realizado com sucesso!</strong></div>";
}
catch (Exception $e)
{
  // desfaz as operacoes caso algum erro tenha ocorrido (e uma exceção lançada)
    $mysqli->rollback();
    echo "Ocorreu um erro na transacao: " . $e->getMessage();
}

}
?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clínica do Povo</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link href="css/home.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="home.php">Clínica do Povo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gallery.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contato</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="schedule.php">Agendamento</a>
          </li>
          <li id="login-li" class="nav-item ml-3">
            <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#loginModal">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="container">
        <div class="modal-content">
          <div class="modal-body">
            <form action="home.php" method="post">
              <div class="form-group">
                <div class="form-label-group">
                  <label for="login">Login</label>
                  <input type="text" id="login" name="email" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="password">Senha</label>
                  <input type="password" id="password" name="password" class="form-control" required>
                </div>
              </div>
              <a class="btn btn-primary btn-block" href="../private/index.php">Entrar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="py-5">
    <div class="container">
      <h1 class="">Agendamento</h1>
      <div class="row">
        <div class="col-md-6 pt-5 mt-4">
          <form role="form" action="schedule.php" method="POST">
            <div class="row">
              <div class="col-6 form-group">
                <label for="especiality">Especialidade médica</label>
                <select name= "especiality" class="custom-select" onchange="loadDoctors(this.value)">
                  <option value="Dermatologia" selected>Dermatologia</option>
                  <option value="Cardiologia">Cardiologia</option>
                  <option value="Pediatria">Pediatria</option>
                  <option value="Ortopedia">Ortopedia</option>
                </select>
              </div>
              <div class="col-6 form-group">
                <label for="doctor">Médico</label>
                <select name="doctor" id="doctors" class="custom-select">
                </select>
              </div>
              <div class="col-6 form-group">
                <label for="date">Data</label>
                <input name="date" class="form-control" type="date" onchange="checkSchedule(this.value)" id="date">
              </div>
              <div class="col-6 form-group">
                <label for="time">Horário</label>
                <select name="hour" id="hours" class="custom-select">
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="name">Nome do paciente</label>
              <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
              <label for="phone">Telefone do paciente</label>
              <input name="phone" type="tel" class="form-control" id="phone" pattern="^\(d{2}) \d{5}-\d{4}$" placeholder="(XX) 99999-9999"
                required>
            </div>
            <button type="submit" class="btn btn-default">Enviar</button>
          </form>
        </div>
        <div class="col-md-6">
          <img class="w-100 rounded" src="./img/schedule.jpg">
        </div>
      </div>
    </div>
  </section>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Programação para Internet - 2018</p>
    </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="./js/schedule.js"></script>

</body>

</html>