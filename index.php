<?php include("general.php") ?>

<?php if($_SERVER['REQUEST_METHOD'] == "POST"){

// var_dump($_POST);
if($_POST['user'] == ""){echo "Usuario incorrecto";}
elseif(!$result == Null){
	echo "Usuario no encontrado";
};
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<?php 


$sql = <<<SQL
    SELECT *
    FROM `usuario`
    WHERE 'usuario' = 'user'
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

 ?>
<table>
	<tr>
		<?php while ($row = $result->fetch_assoc()) { ?>
		<td><?=$row['user'] ?></td>
		<td><?=$row['password'] ?></td>
		<td><?=$row['rut'] ?></td>
		<?php
		} ?>
	</tr>
</table>

<form method="post">
	<p>Logear en el sitio</p>
	<label for="user">Usuario:   </label>
	<input type="text" name="user"><br><br>
	<label for="user">Contraseña:   </label>
	<input type="password" name="password"><br><br>
	<button>Entrar</button><br><br>
</form>

<a href="crear_usuario.php">Crear Usuario</a>

</body>
</html>