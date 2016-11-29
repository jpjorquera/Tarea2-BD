<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php include("general.php") ?>

<?php 
$error = '';
if(isset($_POST['submit'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $clasificacion = $_POST['clasif'];
    $precio = $_POST['precio'];
    if ($titulo == ""){
    	$error = 'Ingrese un título válido';
    }
    else {
    	if ($clasificacion == ""){
    		$clasificacion = 'TE';
    	}
    	if ($precio == ""){
    		$precio = 5000;
    	}
    	$result = mysqli_query($db, "INSERT INTO PELICULA ( titulo, genero, clasificacion, precio )
                       VALUES
                       ( '$titulo', '$genero', '$clasificacion', '$precio' );");
    	$max_id = mysqli_query($db, "SELECT max(id_pelicula) FROM cinema.PELICULA");
    	$ids = mysqli_fetch_row($max_id);
    	$id_actual = -1;
    	foreach ($ids as $id_actual);
    	$actores = $_POST['nom_actores'];
    	$director = $_POST['nom_director'];
    	if ($director != ""){
    		$array_directores = preg_split('/[,]+/', $director, -1, PREG_SPLIT_NO_EMPTY);
    		foreach ($array_directores as $dir){
    			$dir = trim($dir);
    			$result = mysqli_query($db, "SELECT * FROM DIRECTOR WHERE nombre='$dir'");
				$num_filas =  mysqli_num_rows($result);
				if ($num_filas == 0){
					$result = mysqli_query($db, "INSERT INTO DIRECTOR ( nombre )
                       VALUES
                       ( '$dir' );");
				}
				$result = mysqli_query($db, "INSERT INTO DIRIGE ( DIRECTOR_nombre, PELICULA_id_pelicula )
                       VALUES
                       ( '$dir', '$id_actual' );");
    		}
    	}
    	if ($actores != ""){
    		$array_actores = preg_split('/[,]+/', $actores, -1, PREG_SPLIT_NO_EMPTY);
    		foreach ($array_actores as $act){
    			$act = trim($act);
    			$result = mysqli_query($db, "SELECT * FROM ACTOR WHERE nombre='$act'");
				$num_filas =  mysqli_num_rows($result);
				if ($num_filas == 0){
					$result = mysqli_query($db, "INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( '$act' );");
				}
				$result = mysqli_query($db, "INSERT INTO ACTUA ( ACTOR_nombre, PELICULA_id_pelicula )
                       VALUES
                       ( '$act', '$id_actual' );");
    		}
    	}
    }
}

 ?>

<p>Ingresar pelicula</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='empleado.php'">Volver</button>

<form action="" method="post">
	<p><strong><?php echo $error; ?></strong></p>
	<label for="user"> Título:   </label>
	<input type="text" name="titulo" id="titulo"><br><br>
	<label for="user"> Género:   </label>
	<input type="text" name="genero"><br><br>
	<label for="user"> Clasificación:   </label>
	<input type="text" name="clasif"><br><br>
	<label for="user"> Precio:   </label>
	<input type="text" name="precio"><br><br>
	<label for="user"> Nombre Actores (Separados por ","):   </label>
	<input size="100" type="text" name="nom_actores"><br><br>
	<label for="user"> Nombre Director(es) (Separados por ","):   </label>
	<input size="100" type="text" name="nom_director"><br><br>
	<input type="submit" name="submit" value="Ingresar Película" class="btn btn-primary"/><br/>
</form>

</body>
</html>