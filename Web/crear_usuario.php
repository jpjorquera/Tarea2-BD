<?php include("general.php") ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<p><?php 
$error = '';
 ?></p>

<?php 
if(isset($_POST['submit'])) {
    $user = $_POST['us'];
	$error='';
	if ($result = mysqli_query($db, "SELECT * FROM usuario WHERE user='$user'")) {
    	$num_filas =  mysqli_num_rows($result);
    	if($num_filas != 0) {
			$error = "Nombre de usuario ya usado";
			mysqli_free_result($result);
		}
		else {
			$error = '';
			mysqli_free_result($result);
			$pass = $_POST['password'];
			$rut = $_POST['rut'];
			$result = mysqli_query($db, "INSERT INTO usuario ( user, rut, password )
                       VALUES
                       ( '$user', '$rut', '$pass' );");
			$result = mysqli_query($db, "INSERT INTO cliente ( USUARIO_user )
                       VALUES
                       ( '$user' );");
			$error = 'Usuario creado correctamente';
		}
	}
}

 ?>

	<div id="center_button">
    <button onclick="location.href='index.php'">Home</button>
	</div><br>

	<form method="post">
		<p><strong><?php echo $error; ?></strong></p>
		<label for="user">Usuario: </label>
		<input type="text" name="us" id="us"><br><br>
		<label for="rut">Rut: </label>
		<input type="text" name="rut"><br><br>
		<label for="user">Contraseña: </label>
		<input type="password" name="password"><br><br>
		<input type="submit" name="submit" value="Entrar" class="btn btn-primary"/><br/>
	</form>

</body>
</html>