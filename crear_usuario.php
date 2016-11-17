<?php include("general.php") ?>

<?php if($_SERVER['REQUEST_METHOD'] == "POST"){

var_dump($_POST);

}
else{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post">
		<label for="user">Usuario: </label>
		<input type="text" name="user"><br>
		<label for="rut">Rut: </label>
		<input type="text" name="rut"><br>
		<label for="user">Contraseña: </label>
		<input type="password" name="password"><br>
		<button>Guardar</button>
	</form>
</body>
</html>
<?php } ?>