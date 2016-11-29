<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php include("general.php") ?>


<p>Ingresar pelicula vendedor</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='vendedor.php'">Volver</button>

<form action="" method="post">
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
    echo $select_pelis;
    ?>
  <input type="submit" name="submit" value="Aceptar" class="btn btn-primary"/><br/>


<?php 
if(isset($_POST['submit'])) { ?>

  <br><br><label for="user"> Día:   </label>
    <select name="dia">
      <option value=1>Lunes</option>
      <option value=2>Martes</option>
      <option value=3>Miércoles</option>
      <option value=4>Jueves</option>
      <option value=5>Viernes</option>
      <option value=6>Sábado</option>
      <option value=7>Domingo</option>
    </select>
  <input type="submit" name="submit2" value="Aceptar" class="btn btn-primary"/><br/>

<?}
?>

<form action="" method="post">
  <br><br><label for="user"> Hora:   </label>
  <?php 
$error = '';
if(isset($_POST['submit2'])) {
    $resultpeli = $_POST['pelis'];
    $resultdia = $_POST['dia'];

    $max_id = mysqli_query($db, "SELECT count(PELICULA_id_pelicula) FROM cinema.FUNCION WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' ");
    $ids = mysqli_fetch_row($max_id);
    $max_fun = -1;
    $select_fun = '<select name="fun">';
    foreach ($ids as $max_fun);
    $result = mysqli_query($db, "SELECT hora FROM cinema.FUNCION WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' ");
    for ($i=1; $i <= $max_fun; $i++) { 
      $fun = mysqli_fetch_row($result);
      foreach ($fun as $fu) {
        $select_fun .= "<option value =   $i />  $fu  </option>";
     }
    }
    $select_fun .= "</select>" ;
    echo $select_fun;  
}
 ?>
 <input type="submit" name="submit3" value="Aceptar" class="btn btn-primary"/><br/>

 <form action="" method="post">
  <br><br><label for="user"> Asientos Disponibles:   </label>

  <?php
  if(isset($_POST['submit2'])) {
    $resultpeli = $_POST['pelis'];
    $resultdia = $_POST['dia'];
    $resulthora = $_POST['fun'];
    $actual = mysqli_query($db, "SELECT n_ticket FROM cinema.TICKET WHERE FUNCION_PELICULA_id_pelicula = '$resultpeli' AND FUNCION_dia = '$resultdia' AND FUNCION_hora = '$fun' ");
    $num_actual = mysqli_num_rows($actual);
    $max = mysqli_query($db, "SELECT n_asiento FROM cinema.SALA, cinema.FUNCION WHERE FUNCION.PELICULA_id_pelicula = '$resultpeli' AND FUNCION.dia = '$resultdia' AND FUNCION.hora = '$fun' AND FUNCION.SALA_n_sala = SALA.n_sala ");
    if(($max - $num_actual) > 0){
      echo $max - $num_actual;
    }
    else{
      echo '0, Lo siento, no hay asientos disponibles.';
    }
  }
  ?>



	<p><strong><?php echo $error; ?></strong></p>
	<label for="user"> Número de Sala:   </label>
	<input type="text" name="num_sala" id="num_sala">
  <label for="user"> Hora(HH:MM):   </label>
  <input type="text" name="hora"><br><br>
</form>

</body>
</html>