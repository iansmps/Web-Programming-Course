<?php

/*class Endereco 
{
  public $rua;
  public $bairro;
  public $cidade;
}

try
{
	require_once "../php/auth.php";
	require_once "../php/database-connection.php";

	$mysqli = connect();

	$endereco = "";
	$cep = "";
	if (isset($_POST["cep"]))
		$cep = $_POST["cep"];

	$SQL = "
		SELECT LOGRADOURO, BAIRRO, CIDADE
		FROM ENDERECOFUNC
		WHERE CEP = '$cep';
	";

	if (! $result = $mysqli->query($SQL))
		throw new Exception('Ocorreu uma falha ao buscar o endereco: ' . $mysqli->error);

	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();

		$endereco = new Endereco();

		$endereco->rua    = $row["LOGRADOURO"];
		$endereco->bairro = $row["BAIRRO"];
		$endereco->cidade = $row["CIDADE"];
	}
	
	$jsonStr = json_encode($endereco);
	echo $jsonStr;	
}
catch (Exception $e)
{
	// altera o código de retorno de status para '500 Internal Server Error'.
	// A função http_response_code deve ser chamada antes do script enviar qualquer
	// texto para a saída padrão 
	http_response_code(500); 
	
	$msgErro = $e->getMessage();
	echo $msgErro;
}

if ($mysqli != null)
	$mysqli->close();*/

require_once "../php/auth.php";
require_once "../php/database-connection.php";

$mysqli = connect();

if($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["cep"]) {

  $cep = $_GET["cep"];
  $mysqli = connect();
  $stmt = $mysqli->prepare("SELECT LOGRADOURO, BAIRRO, CIDADE FROM ENDERECOFUNC WHERE CEP = ? ");
  $stmt->bind_param("s", $cep);

  if (!$stmt->execute())
    echo "Falha: (" . $stmt->errno . ") " . $stmt->error;
  else {
    $stmt->bind_result($rua, $bairro,$cidade);
    if ($row = $stmt->fetch()) {
      $response[] = array('rua' => $rua, 'bairro' => $bairro, 'cidade'=> $cidade);
    }
    echo json_encode($response);
  }
}

?>