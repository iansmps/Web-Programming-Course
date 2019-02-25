<?php

$a = 1;

function validateUserInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function login($email, $senha, $mysqli)
{
  $SQL = "
    SELECT ID, EMAIL, SENHAHASH 
    FROM USUARIO
    WHERE EMAIL = ?
    LIMIT 1";
  
  $stmt = $mysqli->prepare($SQL);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $stmt->store_result();
  
  // Resgata o resultado nas variáveis
  $stmt->bind_result($idUsuario, $email, $senhaHash);
  $stmt->fetch();
  
  if ($stmt->num_rows == 1)
  {
    if ($senha == $senhaHash)
    {
      // Senha correta
      
      // Armazena dados úteis para confirmação de login
      // em outros scripts PHP
      $_SESSION['idUsuario'] = $idUsuario;
      $_SESSION['email'] = $email;
      $_SESSION['loginString'] = $senhaHash;
      
      // Sucesso no login
      return true;
    }
    else
    {
      // Senha incorreta
      return false;
    }
  }
  else
  {
    // Usuário não existe
    return false;
  }
}

function loggedUser($mysqli)
{
  // Check if all session variables are set
  if (!isset($_SESSION['idUsuario'], $_SESSION['loginString']))
    return false;
  
  $idUsuario = $_SESSION['idUsuario'];
  $loginString = $_SESSION['loginString'];
    
  $SQL = "
    SELECT SENHAHASH 
    FROM USUARIO
    WHERE ID = ?
    LIMIT 1";
  
  $stmt = $mysqli->prepare($SQL);
  $stmt->bind_param('i', $idUsuario);
  $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows == 1)
  {
    $stmt->bind_result($senhaHash);
    $stmt->fetch();
    
    $loginStringCheck = $senhaHash;
    
    if ($loginStringCheck == $loginString)
      return true;
  }
  
  return false;
}

function checkLoggedUserOrDie($mysqli)
{
  if (!loggedUser($mysqli))
  {
    $mysqli->close();
    header("Location: ../public/home.php");
    die();
  }
}