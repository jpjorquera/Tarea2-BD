<?php include("general.php") ?>

<p><?php 
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
	$error='';
	if ($result = mysqli_query($db, "SELECT * FROM USUARIO WHERE user='$user'")) {
    	$num_filas =  mysqli_num_rows($result);
    	if($num_filas == 0) {
			$error = "Usuario no existe en la base de datos";
			mysqli_free_result($result);
		}
		else {
			$error = '';
			mysqli_free_result($result);
			$pass = $_POST['password'];
			$result = mysqli_query($db, "SELECT * FROM USUARIO WHERE user='$user' AND password='$pass'");
			$num_filas =  mysqli_num_rows($result);
			if($num_filas == 0) {
				$error = "Contraseña incorrecta";
				mysqli_free_result($result);
			}
			else {
				mysqli_free_result($result);
				$result = mysqli_query($db, "SELECT * FROM EMPLEADO, VENDEDOR WHERE USUARIO_user='$user' AND id_empleado = EMPLEADO_id_empleado");
				$num_filas =  mysqli_num_rows($result);
				if($num_filas != 0){
					mysqli_free_result($result);
					header('Location: vendedor.php');
				}
				else{
					$result = mysqli_query($db, "SELECT * FROM EMPLEADO, PROYECTADOR WHERE USUARIO_user='$user' AND id_empleado = EMPLEADO_id_empleado");
					$num_filas =  mysqli_num_rows($result);
					if($num_filas != 0){
						mysqli_free_result($result);
						header('Location: proyectador.php');
					}
					else {
						mysqli_free_result($result);
						header('Location: logeado.php');
					}
				}
			}
		}
	}
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