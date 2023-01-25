<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Se a sessão não está ativa...
if(!isset($_SESSION['login_user']))
{
  header("Location: index.php");
}

$username = $_SESSION['login_user'];

echo "<br>Username: ".$username;


if (!isset($_POST['destinatario'])) {
  die("Não foi definido o destinatario da mensagem");
}
else $destinatario = $_POST['destinatario'];



if (!isset($_POST['mensagem'])) {
  die("Mensagem vazia");
}
else $mensagem = $_POST['mensagem'];


echo "<p>Destinatario: ".$destinatario;
echo "<p>Mensagem: ".$mensagem;


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "batepapo";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

$sqlQuery="INSERT INTO mensagens (autor,destinatario,mensagem) VALUES ('$username','$destinatario','$mensagem');";

echo "<p>Query: ".$sqlQuery;
	
$result = $conn->query($sqlQuery);

$conn -> close();

header("Location: welcome.php");


?>
