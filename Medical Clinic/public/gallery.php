<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clínica do Povo</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link href="css/home.css" rel="stylesheet">
  <link href="css/gallery.css" rel="stylesheet">


</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="home.html">Clínica do Povo</a>
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
          <li class="nav-item active">
            <a class="nav-link" href="gallery.php">Galeria</a>
          </li>
          <li class="nav-item">
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
            <form>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="login">Login</label>
                  <input type="text" id="login" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="password">Senha</label>
                  <input type="password" id="password" class="form-control" required>
                </div>
              </div>
              <a class="btn btn-primary btn-block" href="../private/index.html">Entrar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<section>

  <div class="container">

  <table class="table centered responsive-table" border="0">
   <tbody>
    <tr>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-1.jpg" id="img01"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-2.jpg" id="img02"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-3.jpg" id="img03"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-4.jpg" id="img04"></td>
    </tr>
    <tr>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-5.jpg" id="img05"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-6.jpg" id="img06"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-7.jpg" id="img07"></td>
      <td><img class="imgGalery imgShow" onmouseenter="redBorder(this)" onmouseleave="cleanBorder(this)" src="./img/gallery-8.jpg" id="img08"></td>
    </tr>
  </tbody>
  </table>
</div>
  <table class="table centered" border="0" style="horizontal-align:center;">
    <tr>
      <td><iframe class="vidGalery imgShow" src="https://www.youtube.com/embed/eUwSZZF5-eI?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td>
    </tr>
  </table>

</section>


  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Programação para Internet - 2018</p>
    </div>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="./js/gallery.js"></script>
</body>

</html>