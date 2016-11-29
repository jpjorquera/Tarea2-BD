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
    $resultcine = $_POST['cines'];
    $resultpeli = $_POST['pelis'];
    $fecha = $_POST['dia'];
    $sala = $_POST['num_sala'];
    $hora = $_POST['hora'];

    if($sala==''){
      $error = 'Ingrese una sala válida';
    }
    else{
      $validar = mysqli_query($db, "SELECT * FROM cinema.CINE, cinema.SALA WHERE CINE.id_cine='$resultcine' AND SALA.n_sala = '$sala'");
      $num_filas =  mysqli_num_rows($validar);
      if($num_filas == 0) {
        $error = "Ingrese una sala válida";
      }
      else{
        if (preg_match("/([0-1][0-9]|[0-2][0-3]):([0-5][0-9]|[0-5][0-9])/", $hora)){
          $result = mysqli_query($db, "INSERT INTO FUNCION ( SALA_n_sala, PELICULA_id_pelicula, dia, hora )
            VALUES
            ( '$sala', '$resultpeli', '$fecha', '$hora' );");
        }
        else{
          $error = 'Ingrese una hora válida (HH:MM)';
        }
      }
    }
    
    	
}

 ?>

<p>Ingresar función</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='empleado.php'">Volver</button>

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

	<p><strong><?php echo $error; ?></strong></p>
	<label for="user"> Número de Sala:   </label>
	<input type="text" name="num_sala" id="num_sala">

  <br><br><label for="user"> Día:   </label>
  <select name="dia">
    <option value=1>Lunes</option>
    <option value=2>Martes</option>
    <option value=3>Miércoles</option>
    <option value=4>Jueves</option>
    <option value=5>Viernes</option>
    <option value=6>Sábado</option>
    <option value=7>Domingo</option>
  </select><br><br>

  <label for="user"> Hora(HH:MM):   </label>
  <input type="text" name="hora"><br><br>
	<input type="submit" name="submit" value="Ingresar Función" class="btn btn-primary"/><br/>
</form>

</body>
</html>