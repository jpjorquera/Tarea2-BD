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
    $selectOption = $_POST['cines'];
    echo "Opcion $selectOption";

    $sala = $_POST['num_sala'];
    $fecha = $_POST['fecha'];
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

<p>Ingresar pelicula vendedor</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='vendedor.php'">Volver</button>

<form action="" method="post">
  <br><br><label for="user"> Cine:   </label>
  <?php
    $max_id = mysqli_query($db, "SELECT max(id_cine) FROM cinema.CINE");
    $ids = mysqli_fetch_row($max_id);
    $max_cine = -1;
    $select_cines = '<select name="cines">';
    foreach ($ids as $max_cine);
    $result = mysqli_query($db, "SELECT comuna FROM cinema.CINE");
    for ($i=1; $i <= $max_cine; $i++) { 
      $cines = mysqli_fetch_row($result);
      foreach ($cines as $cine) {
        $select_cines .= "<option value =   $i />  $cine  </option>";
     }
    }
    $select_cines .= "</select>";
    echo $select_cines;
  ?>
  <br><br><label for="user"> Película:   </label>
  <?php 
    $max_id = mysqli_query($db, "SELECT max(id_pelicula) FROM cinema.PELICULA");
    $ids = mysqli_fetch_row($max_id);
    $max_pelis = -1;
    $select_pelis = '<select name="pelis">';
    foreach ($ids as $max_pelis);
    $result = mysqli_query($db, "SELECT titulo FROM cinema.PELICULA");
    for ($i=1; $i <= $max_pelis; $i++) { 
      $pelis = mysqli_fetch_row($result);
      foreach ($pelis as $peli) {
        $select_pelis .= "<option value =   $i />  $peli  </option>";
     }
    }
    $select_pelis .= "</select>" ;
    echo $select_pelis
    ?>
  <br>

	<p><strong><?php echo $error; ?></strong></p>
	<label for="user"> Número de Sala:   </label>
	<input type="text" name="num_sala" id="num_sala"><br><br>
	<label for="user"> Fecha/hora:   </label>
	<input type="text" name="fecha"><br><br>
	<input type="submit" name="submit" value="Ingresar Función" class="btn btn-primary"/><br/>
</form>

</body>
</html>