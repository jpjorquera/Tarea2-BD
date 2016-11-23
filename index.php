<?php include("general.php") ?>

<p><?php 
var_dump($_POST);
$error = '';
 ?></p>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>



<?php 

if(isset($_POST['submit'])) {
    $user = $_POST['us'];
	echo "<p>El usuario ingresado es: $user \r\n </p>";
	

	$sql = "SELECT COUNT(*) FROM usuario WHERE user = " + $user;;
	$result = $db->query($sql);
	$error='';
		echo " El resultado del SELECT es: $sql";
	if($sql == 0) {
		$error = "Usuario no existe en la base de datos";
	}
	else {
		echo "asdASD";
		$error = '';
		header('Location: logeado.php');
	}

 //   $error='';
//	if($result->num_rows == 0){
//		$error = "Usuario no existe en la base de datos";
//	}
//	if(!$result = $db->query($sql)){
//	    die('There was an error running the query [' . $db->error . ']');
//	}


	//$userCount = $row->count;
}

 ?>

<form action="" method="post">
	<p><strong><?php echo $error; ?></strong></p>
	<p>Logear en el sitio</p>
	<label for="user">Usuario:   </label>
	<input type="text" name="us" id="us"><br><br>
	<label for="user">Contraseña:   </label>
	<input type="password" name="password"><br><br>
	<input type="submit" name="submit" value="Entrar" class="btn btn-primary"/><br/>
</form>

<p><a href="crear_usuario.php">Crear Usuario</a></p>

</body>
</html>