<?php

require_once "../php/auth.php";
require_once "../php/database-connection.php";

session_start();
$mysqli = connect();
checkLoggedUserOrDie($mysqli);

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = validateUserInput($_POST['name']);
  $birth_date = validateUserInput($_POST['birth_date']);
  $gender = validateUserInput($_POST['gender']); 
  $civil_status = validateUserInput($_POST['civil_status']); 
  $charge = validateUserInput($_POST['charge']); 
  $especiality = validateUserInput($_POST['especiality']); 
  $cpf = validateUserInput($_POST['cpf']);
  $rg = validateUserInput($_POST['rg']);
  $other = validateUserInput($_POST['other']);
  $cep = validateUserInput($_POST['cep']);
  $complement = validateUserInput($_POST['complement']);
  $address_type = validateUserInput($_POST['address_type']);
  $neighborhood = validateUserInput($_POST['neighborhood']);
  $address = validateUserInput($_POST['address']);
  $city = validateUserInput($_POST['city']);
  $address_number = validateUserInput($_POST['address_number']);
  $state = validateUserInput($_POST['state' ]);

  $mysqli = connect();
  echo $mysqli->connect_error;

  

  try
	{
	  $mysqli->begin_transaction();

	  $stmt = $mysqli->prepare("INSERT INTO ENDERECOFUNC (CEP, TIPO, LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, ESTADO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	  $stmt->bind_param("sssissss", $cep, $address_type, $address, $address_number, $complement, $neighborhood, $city, $state);
	  
	  if (!$stmt->execute())
	    throw new Exception('Erro ao inserir na tabela endereço');

	  $last_id = $stmt->insert_id;
	  $stmt = $mysqli->prepare("INSERT INTO FUNCIONARIO (NOME, DATA_NASC, SEXO, ESTADO_CIVIL, CARGO, ESPECIALIDADE_MEDICA, CPF, RG, OUTRO, FK_ENDERECO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	  $stmt->bind_param("sssssssssi", $name, $birth_date, $gender, $civil_status, $charge, $especiality, $cpf, $rg, $other, $last_id);
	    
	  if(!$stmt->execute())
	    throw new Exception('Erro ao inserir na tabela Funcionario');

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
    <!-- Sidebar -->
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
        <h1>Novo funcionário</h1>
        <form method="post" class="pt-3">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nome do funcionário</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="birth-date" class="col-sm-2 col-form-label">Data de nascimento</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="birth_date" required>
            </div>
          </div>
          <fieldset class="form-group">

            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
              <div class="col-sm-10">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="gender" value="M" class="custom-control-input" required>
                  <label class="custom-control-label" for="customRadioInline1">Masculino</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="gender" value ="F" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">Feminino</label>
                </div>
              </div>
            </div>
          </fieldset>
          <div class="form-group row">
            <label for="birth-date" class="col-sm-2 col-form-label">Estado civil</label>
            <div class="col-sm-10">
              <select class="custom-select" name="civil_status" required>
                <option value="Casado(a)" selected>Casado(a)</option>
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="Divorciado(a)">Divorciado(a)</option>
                <option value="Viúvo(a)">Viúvo(a)</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="birth-date" class="col-sm-2 col-form-label">Cargo</label>
            <div class="col-sm-10">
              <select id="charge" name="charge" class="custom-select" required>
                <option value="Médico(a)" selected>Médico(a)</option>
                <option value="Enfermeiro(a)">Enfermeiro(a)</option>
                <option value="Secretário(a)">Secretário(a)</option>
                <option value="Outro(a)">Outro(a)</option>
              </select>
            </div>
          </div>
          <div id="medic-especiality" class="form-group row">
            <label for="birth-date" class="col-sm-2 col-form-label">Especialidade médica</label>
            <div class="col-sm-10">
              <select class="custom-select" name="especiality">
                <option value="Ortopedia" selected>Ortopedia</option>
                <option value="Cardiologia">Cardiologia</option>
                <option value="Dermatologia">Dermatologia</option>
                <option value="Pediatra">Pediatra</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="cpf" required maxlength="11">
            </div>
          </div>
          <div class="form-group row">
            <label for="rg" class="col-sm-2 col-form-label">RG</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="rg" required maxlength="9">
            </div>
          </div>
          <div class="form-group row">
            <label for="other" class="col-sm-2 col-form-label">Outro</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="other" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="cep" class="col-sm-2 col-form-label">CEP</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="cep" maxlength="8" onkeyup="buscaEndereco(this.value)">
            </div>
            <label for="complement" class="col-sm-2 col-form-label">Complemento</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="complement">
            </div>
          </div>
          <div class="form-group row">
            <label for="address-type" class="col-sm-2 col-form-label">Tipo de logradouro (rua/avenida/praça)</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="address_type">
            </div>
            <label for="neighborhood" class="col-sm-2 col-form-label">Bairro</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="neighborhood">
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Logradouro</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="address">
            </div>
            <label for="city" class="col-sm-2 col-form-label">Cidade</label>
            <div class="col-sm-4">
              <input type="text" id="test" class="form-control" name="city">
            </div>
          </div>
          <div class="form-group row">
            <label for="address-number" class="col-sm-2 col-form-label">Número</label>
            <div class="col-sm-4">
              <input type="number" class="form-control"min="1" name="address_number">
            </div>
            <label for="state" class="col-sm-2 col-form-label">Estado</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="state">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 pt-3">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="./js/employee-register.js"></script>
</body>

</html>