<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<?php 
  include("general.php");
  session_start();
  ?>


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
  if(isset($_POST['submit']) or !empty($_SESSION["verificar_dia"]) ) { 
    $selectOption = $_POST['pelis'];
    $_SESSION["verificar_dia"] = $selectOption;
    $mostrar = '<br><br><label for="user"> Dia:   </label>';
    $select_dia = '<select name="dia">';
    $select_dia .= '<option value="1">Lunes</option>';
    $select_dia .= '<option value="2">Martes</option>';
    $select_dia .= '<option value="3">Miércoles</option>';
    $select_dia .= '<option value="4">Jueves</option>';
    $select_dia .= '<option value="5">Viernes</option>';
    $select_dia .= '<option value="6">Sábado</option>';
    $select_dia .= '<option value="7">Domingo</option>';
    $select_dia .= '</select>';
    echo $mostrar;
    echo $select_dia;
    $guardar = '<input type="submit" name="submit2" value="Aceptar" class="btn btn-primary"/><br/>';
    echo $guardar;

    if( isset($_POST['submit2']) or !empty($_SESSION["verificar_hora"]) ) {
      $selectOption = $_POST['dia'];
      $_SESSION["verificar_hora"] = $selectOption;
      $mostrar = '<br><br><label for="user"> Hora:   </label>';
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
    echo $mostrar;
    echo $select_fun;
    $guardad = '<input type="submit" name="submit3" value="Aceptar" class="btn btn-primary"/><br/>';
    echo $guardar;
    }


  }
  ?>





</body>
</html>