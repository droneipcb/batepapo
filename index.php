<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$error="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form 

//não há qualquer verificação dos dados de entrada
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "batepapo";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);


$sqlQuery="SELECT * FROM users WHERE username='$myusername' and password='$mypassword';";
	
$result = $conn->query($sqlQuery);
	
if ($result->num_rows > 0  &&  $row = $result->fetch_assoc()) {
	$_SESSION['login_user'] = $row['username'];
	$_SESSION['user_role'] = $row['role'];

	$conn -> close(); 
	header("location: welcome.php");
}

else  {
	$conn -> close();
	$error="Your Login Name or Password is invalid";
}

}



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<head>

<link rel="stylesheet" type="text/css" href="styles.css">

<script src="jquery-3.3.1.min.js"></script>

<title>Login Page</title>

</head>



<script>

$(document).ready(function() {

    $("#auth").hide().fadeIn(1000);

});

</script>
<h1>Bate Papo - Mensageiro seguro</h1>


<div id="auth" class="auth_div">
	<form action="" method="post">
		<label>UserName</label>
		<input id="username" type="text" name="username" class="box"/><br /><br />

		<label>Password</label>
		<input  id="password" type="password" name="password" class="box" /><br/><br />

		<input class="login_button" type="submit" value=" Login "/><br />

	</form>
	<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</div>
</body>
</html>
