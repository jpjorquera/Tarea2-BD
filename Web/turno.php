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
  error_reporting(E_WARNING);
  ?>

<p>Gestión de Turnos</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='empleado.php'">Volver</button>

<form action="" method="post">
<?php
    
    $SESIONVENDEDOR = $_SESSION['usuario'];


    $row = mysqli_query($db, "SELECT id_empleado FROM cinema.EMPLEADO WHERE USUARIO_user = '$SESIONVENDEDOR' ");
    foreach (mysqli_fetch_row($row) as $IDempleado);
    $IDempleado;

    $row = mysqli_query($db, "SELECT CINE_id_cine FROM cinema.EMPLEADO WHERE USUARIO_user = '$SESIONVENDEDOR' ");
    foreach (mysqli_fetch_row($row) as $cineActual);
    $cineActual;

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

    $mostrar = '<br><br><label for="user"> Hora:   </label>';
    $select_hora = '<select name="hora">';
    for ($i=0 ; $i < 24; $i++) { 
      $select_hora .= "<option value=$i>$i</option>" ;
    }
    $select_hora .= '</select>';
    echo $mostrar;
    echo $select_hora;

    $mostrar = '<br><br><label for="user"> Sala:   </label>';
    $max_id = mysqli_query($db, "SELECT count(n_sala) FROM cinema.SALA WHERE CINE_id_cine = '$cineActual' ");
    $ids = mysqli_fetch_row($max_id);
    $max_fun = -1;
    $select_fun = '<select name="salas">';
    foreach ($ids as $max_fun);
    $result = mysqli_query($db, "SELECT n_sala FROM cinema.SALA WHERE CINE_id_cine = '$cineActual' ");
    for ($i=1; $i <= $max_fun; $i++) { 
      $fun = mysqli_fetch_row($result);
      foreach ($fun as $fu) {
        $select_fun .= "<option value =   $fu />  $fu  </option>";
     }
    }
    $select_fun .= "</select>" ;
    echo $mostrar;
    echo $select_fun;
    

?>

    <br><br><input type="submit" name="registrar" value="REGISTRAR TURNO" class="btn btn-primary"/><br/>

<?php
  if( isset($_POST['registrar']) ) {
      $numero_sala = $_POST['salas'];
      $numero_hora = $_POST['hora'];
      $numero_dia = $_POST['dia'];
      $result = mysqli_query($db, "SELECT PROYECTADOR_EMPLEADO_id_empleado FROM cinema.TURNO WHERE SALA_CINE_id_cine = '$cineActual' and SALA_n_sala = '$numero_sala' AND PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' AND hora = '$numero_hora' ");
      $validar = mysqli_num_rows($result);
      if ( $validar != 0) {
        echo 'Error, Turno ya ocupado';
      }
      else{
        mysqli_query($db, "INSERT INTO TURNO ( hora, dia, PROYECTADOR_EMPLEADO_id_empleado, SALA_n_sala, SALA_CINE_id_cine)
                         VALUES
                         ( '$numero_hora', '$numero_dia' , '$IDempleado' , '$numero_sala', '$cineActual' );");
      }
    }

?>


<br><br><input type="submit" name="borrarTurno" value="VER MIS TURNOS" class="btn btn-primary"/><br/>

<?php

  if( isset($_POST['borrarTurno']) ){
    $mostrar = '<br><br><label for="user"> Dia:   </label>';
    $max_id = mysqli_query($db, "SELECT count(PROYECTADOR_EMPLEADO_id_empleado) FROM cinema.TURNO WHERE PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' ");
    $ids = mysqli_fetch_row($max_id);
    $max_fun = -1;
    $select_fun = '<select name="fun">';
    foreach ($ids as $max_fun);
    $result = mysqli_query($db, "SELECT DISTINCT dia FROM cinema.TURNO, cinema.SALA WHERE PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' ");
    for ($i=1; $i <= mysqli_num_rows($result); $i++) { 
      $fun = mysqli_fetch_row($result);
      foreach ($fun as $fu) {
        if($fu=='1'){ 
          $fuc='Lunes';
        }
        if($fu=='2'){
          $fuc='Martes';
        }
        if($fu=='3'){
          $fuc='Miercoles';
        }
        if($fu=='4'){
          $fuc='Jueves';
        }
        if($fu=='5'){ 
          $fuc='Viernes';
        }
        if($fu=='6'){
          $fuc='Sabado';
        }
        if($fu=='7'){
          $fuc='Domingo';
        }
        $select_fun .= "<option value =   $fu />  $fuc  </option>";
      }
    }
    $select_fun .= "</select>" ;
    echo $mostrar;
    echo $select_fun;
    $guardar = '<input type="submit" name="diaT" value="Aceptar" class="btn btn-primary"/><br/>';
    echo $guardar;
  }

?>

<?php

  if( isset($_POST['diaT']) and empty( $_POST['hora']) ){
    $resultdiaT= $_POST['fun'];
    $_SESSION["verificarDIA"] = $resultdiaT;
    
    $mostrar = '<br><br><label for="user"> Hora:   </label>';
      $max_id = mysqli_query($db, "SELECT count(PROYECTADOR_EMPLEADO_id_empleado) FROM cinema.TURNO WHERE PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' AND dia = '$resultdiaT' ");
      $ids = mysqli_fetch_row($max_id);
      $max_fun = -1;
      $select_fun = '<select name="hora2">';
      foreach ($ids as $max_fun);
      $result = mysqli_query($db, "SELECT hora FROM cinema.TURNO WHERE PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' AND dia = '$resultdiaT' ");
      for ($i=1; $i <= $max_fun; $i++) { 
        $fun = mysqli_fetch_row($result);
        foreach ($fun as $fu) {
          $select_fun .= "<option value =   $fu />  $fu  </option>";
       }
      }
      $select_fun .= "</select>" ;
      echo $mostrar;
      echo $select_fun;
      $guardar = '<br><br><input type="submit" name="borrar" value="BORRAR TURNO" class="btn btn-primary"/><br/>';
      echo $guardar;
  }
?>

<?php
  $resultdiaT= $_POST['fun'];
  if( isset($_POST['borrar']) ){
    $resulthoraT = $_POST['hora2'];
    $result = mysqli_query($db, "DELETE FROM cinema.TURNO WHERE PROYECTADOR_EMPLEADO_id_empleado = '$IDempleado' AND dia = $_SESSION[verificarDIA] AND hora = '$resulthoraT' ");
  }
?>




</form>

</body>
</html>