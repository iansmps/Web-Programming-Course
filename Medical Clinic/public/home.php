<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = validateUserInput($_POST['email']);
  $password = validateUserInput($_POST['password']); 
  
  $mysqli = connect();
  if(login($email, $password, $mysqli)){
    header("Location: ../private/index.php");
  }
  else {
    echo "<div class='alert alert-danger' role='alert'>Usuário/senha inválido(s)</div>";
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
          <li class="nav-item active">
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
          <li class="nav-item">
            <a class="nav-link" href="schedule.php">Agendamento</a>
          </li>
          <li id="login-li" class="nav-item ml-3">
            <a class="nav-link" href="#loginModal" data-toggle="modal">Login</a>
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
                  <label for="email">E-mail</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="password">Senha</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <header class="py-5 bg-image-full" style="background-image: url('img/home-1.jpg')">
    <img class="img-fluid d-block mx-auto" src="img/logo.png" alt="" style="height: 300px;">
  </header>

  <section class="py-5">
    <div class="container" onclick="$('#first').slideToggle();">
      <h1 onmouseover="$(this).css('cursor', 'pointer');">Seja Bem vindo a Clínica do povo</h1>
      <div id="first">
        <p class="lead">Fique a vontade e conheça nossa clínica.</p>
        <p>A Clínica do Povo existe desde 1988 onde começou em Limeira - SP, e hoje já está em mais de 3 estados
          brasileiros</p>
      </div>
    </div>
  </section>

  <section class="py-5 bg-image-full" style="background-image: url('img/home-2.jpg');">
    <div style="height: 400px;"></div>
  </section>

  <section class="py-5">
    <div class="container" onclick="$('#second').slideToggle();">
      <h1 onmouseover="$(this).css('cursor', 'pointer');">Missão e Valores</h1>
      <div id="second">
        <p>Nossa principal missão é prover serviços de saúde de ponta para que nossos pacientes sempre saiam
          tranquilos e principalmente saudáveis.
        </p>
        <p>
          Os valores que a Clínica do Povo carrega são competência, responsabilidade, a partir de um atendimento
          profissional, ético, humano e personalizado.
        </p>
      </div>
    </div>
  </section>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Programação para Internet - 2018</p>
    </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="./js/home.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>