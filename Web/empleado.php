<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 
  session_start();
  $usuario = $_SESSION['usuario'];
  $tipo = $_SESSION['tipo'];
?>
<button onclick="location.href='index.php'">Home</button><br><br>
<button onclick="location.href='ingresar_pelicula.php'">Ingresar Película</button><br><br>
<button onclick="location.href='ingresar_funcion.php'">Ingresar Función</button><br><br>
<button onclick="location.href='cartelera.php'">Ver cartelera</button><br><br>


<?php 
    if ($tipo == "proyectador"){
        echo "<button onclick=\"location.href='turno.php'\">Gestionar Turnos</button><br><br>";
    }
    else {
        echo "<button onclick=\"location.href='venta.php'\">Vender Tickets</button><br><br>";
    }
 ?>

</body>
</html>