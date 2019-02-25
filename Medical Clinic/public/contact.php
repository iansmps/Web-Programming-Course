<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = validateUserInput($_POST['name']);
  $email = validateUserInput($_POST['email']);
  $reason = validateUserInput($_POST['reason']); 
  $message = validateUserInput($_POST['message']); 
  
  $mysqli = connect();
  echo $mysqli->connect_error;
  $stmt = $mysqli->prepare("INSERT INTO CONTATO (NOME, EMAIL, MOTIVO, MENSAGEM) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $reason, $message);

  if (!$stmt->execute())
    echo "Falha: (" . $stmt->errno . ") " . $stmt->error;
  else { 
    echo "<div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Agradecemos pelo feedback!</strong></div>";
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
  <link href="css/contact.css" rel="stylesheet">

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
          <li class="nav-item active">
            <a class="nav-link" href="contact.php">Contato</a>
          </li>
          <li class="nav-item">
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
      <h1 class="">Contato</h1>
      <div class="row">
        <div class="col-md-6 pt-5 mt-4">
          <h4>Envie sua mensagem</h4>
          <form action="contact.php" method="post" role="form">
            <div class="form-group">
              <label for="name">Nome do cliente</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label for="reason">Motivo do contato (Reclamação/Sugestão/Elogio/Dúvida)</label>
              <input type="text" class="form-control" name="reason" required>
            </div>
            <div class="form-group">
              <label for="message">Mensagem</label>
              <textarea class="form-control" name="message" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-default">Enviar</button>
          </form>
        </div>
        <div class="col-md-6">
          <img class="w-100 rounded" src="./img/contact.jpg">
        </div>
      </div>
    </div>
  </section>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Programação para Internet - 2018</p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>