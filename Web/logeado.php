<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<p>Bienvenido a SansanoFilms!</p>
<?php 
  session_start();
  $usuario = $_SESSION['usuario'];
  $tipo = $_SESSION['tipo'];
?>
<button onclick="location.href='index.php'">Home</button><br><br>
<button onclick="location.href='cartelera.php'">Ver cartelera</button><br><br>
<button onclick="location.href='venta.php'">Comprar Tickets</button><br><br>

</body>
</html>