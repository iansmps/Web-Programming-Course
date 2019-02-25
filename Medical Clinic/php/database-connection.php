<?php

define("HOST", "fdb22.awardspace.net"); 
define("USER", "2841379_aula01");
define("PASSWORD", "mcmb1894"); 
define("DATABASE", "2841379_aula01");

function connect()
{
	$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if ($conn->connect_error)
	throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);
	
	return $conn;   
}
?>