<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_role'])) {
  header("Location: index.php");
}

$role = $_SESSION['user_role'];
$username = $_SESSION['login_user'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "otariobank";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

//obter lista de utilizadores
  $sqlQuery="SELECT * FROM users WHERE role='user';";

//a lista vai ficar na variável $result
$result = $conn->query($sqlQuery)->fetch_all(MYSQLI_ASSOC);
	

$conn -> close();


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="styles2.css">
<script src="jquery-3.3.1.min.js"></script>
<title>Welcome to Otário Bank</title>
</head>

<!-- Esta parte contém Javascript -->
<script>
$(document).ready(function() {
    $("#menu_div").animate({width: "220px"});
});
</script>
<!-- Fim do Javascript -->

<body>

<!-- Esta div corresponde ao menu do lado esquerdo -->
<!-- Menu lateral -->
<div id='menu_div'>
   <?php include 'menu.php';?>
</div> 


<!-- Esta div corresponde ao conteudo ao lado direito do menu -->
<div id='conteudo'>
    <h1> Envie uma mensagem para outro utilizador </h1>

    <form action="gravar_mensagem.php" method="post" enctype="multipart/form-data">

    <p> Escolha o destinatário da mensagem</p>
    <select name="destinatario" id="destinatario">
        <?php
          foreach ($result as $row) {
	          echo "\r\n<option value='".$row['username']."'>".$row['username']."</option>";
          }
        ?>
	
    </select>
    
    <p> Escreva a sua mensagem </p>
        <textarea name='mensagem' id='mensagem' > </textarea>
        
        <p><div class='center_content'><input id="submit_button" type="submit" value="Enviar mensagem" name="submit"></div>
    </form>


</div>


</body>
</html>
