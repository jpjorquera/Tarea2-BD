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


<p>Venta de Ticket</p>

<button onclick="location.href='index.php'">Home</button>
<button onclick="location.href='vendedor.php'">Volver</button>

<form action="" method="post">
  <br><br><label for="user"> Película:   </label>
  <?php 

    $SESIONVENDEDOR = $_SESSION['usuario'];

    $row = mysqli_query($db, "SELECT id_empleado FROM cinema.EMPLEADO WHERE USUARIO_user = '$SESIONVENDEDOR' ");
    foreach (mysqli_fetch_row($row) as $IDempleado);

    $row = mysqli_query($db, "SELECT CINE_id_cine FROM cinema.EMPLEADO WHERE USUARIO_user = '$SESIONVENDEDOR' ");
    foreach (mysqli_fetch_row($row) as $cineActual);


    $max_id = mysqli_query($db, "SELECT max(id_pelicula) FROM cinema.PELICULA");
    $ids = mysqli_fetch_row($max_id);
    $max_pelis = -1;
    $select_pelis = '<select name="pelis">';
    foreach ($ids as $max_pelis);
    $result = mysqli_query($db, "SELECT titulo FROM cinema.PELICULA");
    for ($i=1; $i <= $max_pelis; $i++) { 
      $pelis = mysqli_fetch_row($result);
      foreach ($pelis as $peli) {
        $select_pelis .= "<option value =   $i />  

        $peli  </option>";
     }
    }
    $select_pelis .= "</select>" ;
    echo $select_pelis;
    ?>
  <input type="submit" name="submit" value="Aceptar" class="btn btn-primary"/><br/>

  
  <?php
  if(isset($_POST['submit']) or !empty($_POST['pelis']) ) { 
    $resultpeli = $_POST['pelis'];
    $_SESSION["verificar_dia"] = $resultpeli;
    
    $mostrar = '<br><br><label for="user"> Dia:   </label>';
    $select_dia = '<select name="dia">';
    $select_dia .= '<option value="1" 
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "1") echo " selected = "" ";
    ?>
    >Lunes</option>';
    $select_dia .= '<option value="2" 
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "2") echo " selected = "" ";
    ?>
    >Martes</option>';
    $select_dia .= '<option value="3"
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "3") echo " selected = "" ";
    ?>
    >Miércoles</option>';
    $select_dia .= '<option value="4"
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "4") echo " selected = "" ";
    ?>
    >Jueves</option>';
    $select_dia .= '<option value="5"
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "5") echo " selected = "" ";
    ?>
    >Viernes</option>';
    $select_dia .= '<option value="6"
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "6") echo " selected = "" ";
    ?>
    >Sábado</option>';
    $select_dia .= '<option value="7"
    <?php if(isset($_POST["dia"]) && $_POST["dia"] == "7") echo " selected = "" ";
    ?>
    >Domingo</option>';
    $select_dia .= '</select>';
    echo $mostrar;
    echo $select_dia;
    $guardar = '<input type="submit" name="submit2" value="Aceptar" class="btn btn-primary"/><br/>';
    echo $guardar;



    if( isset($_POST['submit2']) or !empty($_SESSION["verificar_hora"]) ) {
      $resultdia = $_POST['dia'];
      echo $resultdia;
      $_SESSION["verificar_hora"] = $resultdia;
      $mostrar = '<br><br><label for="user"> Hora:   </label>';
      $resultpeli = $_POST['pelis'];
      $max_id = mysqli_query($db, "SELECT count(PELICULA_id_pelicula) FROM cinema.FUNCION WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' ");
      $ids = mysqli_fetch_row($max_id);
      $max_fun = -1;
      $select_fun = '<select name="fun">';
      foreach ($ids as $max_fun);

      $result = mysqli_query($db, "SELECT hora FROM cinema.FUNCION, cinema.SALA WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' AND FUNCION.SALA_n_sala = SALA.n_sala AND SALA.CINE_id_cine = '$cineActual' ");
      for ($i=1; $i <= $max_fun; $i++) { 
        $fun = mysqli_fetch_row($result);
        foreach ($fun as $fu) {
          $select_fun .= "<option value =   $fu />  $fu  </option>";
       }
      }
      $select_fun .= "</select>" ;
      echo $mostrar;
      echo $select_fun;
      $guardad = '<input type="submit" name="submit3" value="Aceptar" class="btn btn-primary"/><br/>';
      echo $guardar;

      if( isset($_POST['submit3']) or !empty( $_POST['fun']) ){
        $resulthora = $_POST['fun'];


        $mostrar = '<br><br><label for="user"> Asientos Disponibles:   </label>';
        echo $resultdia;

        $result = mysqli_query($db, "SELECT SALA.n_asientos FROM cinema.SALA, cinema.FUNCION WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' AND hora = '$resulthora' AND SALA_n_sala = n_sala AND CINE_id_cine = '$cineActual' " );
        foreach (mysqli_fetch_row($result) as $max_asientos);

        $result = mysqli_query($db, "SELECT SALA.n_sala FROM cinema.SALA, cinema.FUNCION WHERE PELICULA_id_pelicula = '$resultpeli' AND dia = '$resultdia' AND hora = '$resulthora' AND SALA_n_sala = n_sala AND CINE_id_cine = '$cineActual' " );
        foreach (mysqli_fetch_row($result) as $numeroSala);


        $result = mysqli_query($db, "SELECT count(n_ticket) FROM cinema.TICKET WHERE FUNCION_PELICULA_id_pelicula = '$resultpeli' AND FUNCION_dia = '$resultdia' AND FUNCION_hora = '$resulthora' AND FUNCION_SALA_n_sala = '$numeroSala' " );
        foreach (mysqli_fetch_row($result) as $act_asientos);

        echo $mostrar;
        $asientosDisponibles = $max_asientos - $act_asientos;
        echo $asientosDisponibles;


        if($asientosDisponibles>0){

          $mostrar = '<br><br><label for="user"> Cantidad de Tickets:   </label>';
          $select_dia = '<select name="cantidadTickets">';
          for ($i=1 ; $i <= $asientosDisponibles ; $i++ ) { 
            $select_dia .= "<option value = $i > $i </option>";
          }
          $select_dia .= '</select>';
          echo $mostrar;
          echo $select_dia;


          $mostrar = '<br><br><label for="user"> Usuario:   </label>';
          $max_id = mysqli_query($db, "SELECT count(CLIENTE.id_cliente) FROM cinema.CLIENTE");
          $ids = mysqli_fetch_row($max_id);
          $max_fun = -1;
          $select_fun = '<select name="nombreUsuario">';
          foreach ($ids as $max_fun);
          $result = mysqli_query($db, "SELECT USUARIO_user FROM cinema.CLIENTE");
          for ($i=1; $i <= $max_fun; $i++) { 
            $fun = mysqli_fetch_row($result);
            foreach ($fun as $fu) {
              $select_fun .= "<option value =   $i />  $fu  </option>";
           }
          }
          $select_fun .= "</select>" ;
          echo $mostrar;
          echo $select_fun;
          $guardar = '<br><br><input type="submit" name="submit4" value="REALIZAR COMPRA" class="btn btn-primary"/><br/>';
          echo $guardar;



          if( isset($_POST['submit4']) or !empty( $_POST['nombreUSUARIO']) ){
            $resultCantidad = $_POST['cantidadTickets'];
            $resultUsuario = $_POST['nombreUsuario'];

            mysqli_query($db, "INSERT INTO TRANSACCION ( CLIENTE_id_cliente, VENDEDOR_EMPLEADO_id_empleado)
                         VALUES
                         ('$resultUsuario' , '$IDempleado' );");


            $result = mysqli_query($db, "SELECT id_transaccion FROM cinema.TRANSACCION");
            $id_transaccion = mysqli_num_rows($result);

            echo $id_transaccion;
            echo "|||";
            echo $numeroSala;
            echo "|||";
            echo $resultpeli;
            echo "|||";
            echo $resultdia;
            echo "|||";
            echo $resulthora;

            for ($i=1; $i <= $resultCantidad ; $i++) { 
              mysqli_query($db, "INSERT INTO TICKET ( asiento, TRANSACCION_id_transaccion, FUNCION_SALA_n_sala, FUNCION_PELICULA_id_pelicula, FUNCION_dia, FUNCION_hora )
                         VALUES
                         ( '$i' , '$id_transaccion' , '$numeroSala', '$resultpeli', '$resultdia' , '$resulthora' );");
            }
            
          }
        }

      }
    }

  }
  ?>



</body>
</html>