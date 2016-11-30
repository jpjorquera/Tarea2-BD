<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php 
    include("general.php");
    session_start();
    if (empty($_GET['ingresarCom'])){
        $estadoComentario=false;
    }
    else {
        $estadoComentario=$_GET['ingresarCom'];
    }
    $usuario = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $boton = "";
    $form_comentario = "";
    $error = "";
?>

<?php
    if (!empty($_POST['comentar'])){
        if (isset($_POST['comentar'])) {
            $comentario = $_POST['comentario'];
            if (strlen($comentario) > 200 ){
                $error = "Ingrese comentario de a lo más 200 caracteres";
            }
            else {
                $actual = $_SESSION['peli_actual'];
                if ($tipo == "vendedor" || $tipo == "proyectador"){
                    $comentario = "[E] " . $comentario;
                }
                $result = mysqli_query($db, "INSERT INTO COMENTARIO VALUES
                       ( '$usuario', '$actual', '$comentario');");
                $error = "Comentario ingresado";
            }

        }

    }


 ?>

<?php 
    $titulo = "";
    $genero = "";
    $clasificacion = "";
    $precio = "";
    $actores = "";
    $directores = "";
    $comentarios = "<tr><td>Comentarios: </td>";
	if(isset($_POST['submit']) or ($estadoComentario == true)) {
        if (isset($_POST['submit'])) {
            $estadoComentario = false;
        }
        if ($estadoComentario == false){
            $selectOption = $_POST['pelis'];
            $_SESSION['peli_actual'] = $selectOption;
        }
        else {
            $selectOption = $_SESSION['peli_actual'];
        }
    	$result = mysqli_query($db, "SELECT * FROM PELICULA WHERE id_pelicula=$selectOption");
        $row = $result->fetch_array(MYSQLI_NUM);
        $i = 0;
        foreach ($row as $info) {
            if ($i == 1){
                $titulo .= $info;
            }
            if ($i == 2){
                $genero .= $info;
            }
            if ($i == 3){
                $clasificacion .= $info;
            }
            if ($i == 4){
                $precio .= $info;
            }
            $i++;
        }
        $result = mysqli_query($db, "SELECT * FROM ACTUA WHERE PELICULA_id_pelicula=$selectOption");
        $filas = mysqli_query($db, "SELECT COUNT(*) FROM ACTUA WHERE PELICULA_id_pelicula=$selectOption");
        $fila = $filas->fetch_array(MYSQLI_NUM);
        $cantidad = $fila[0];
        for ($i=0; $i < $cantidad; $i++) { 
            $row = $result->fetch_array(MYSQLI_NUM);
            $j = 0;
            foreach ($row as $info) {
                if ($j % 2 != 0){
                    $actores .= "$info, ";
                }
                $j++;
            }
        }
        $actores = trim($actores, " ,");

        $result = mysqli_query($db, "SELECT * FROM DIRIGE WHERE PELICULA_id_pelicula=$selectOption");
        $filas = mysqli_query($db, "SELECT COUNT(*) FROM DIRIGE WHERE PELICULA_id_pelicula=$selectOption");
        $fila = $filas->fetch_array(MYSQLI_NUM);
        $cantidad = $fila[0];
        for ($i=0; $i < $cantidad; $i++) { 
            $row = $result->fetch_array(MYSQLI_NUM);
            $j = 0;
            foreach ($row as $info) {
                if ($j % 2 != 0){
                    $directores .= "$info, ";
                }
                $j++;
            }
        }
        $directores = trim($directores, " ,");

        $result = mysqli_query($db, "SELECT USUARIO_user, texto FROM COMENTARIO WHERE PELICULA_id_pelicula=$selectOption");
        $filas = mysqli_query($db, "SELECT COUNT(*) FROM COMENTARIO WHERE PELICULA_id_pelicula=$selectOption");
        $fila = $filas->fetch_array(MYSQLI_NUM);
        $cantidad = $fila[0];
        if ($cantidad == 0){
            $comentarios .= '<td>No hay comentarios</td></tr>';
        }
        else {
            for ($i=0; $i < $cantidad; $i++) { 
                $row = $result->fetch_array(MYSQLI_NUM);
                $j = 0;
                foreach ($row as $info) {
                    if ($j % 2 == 0){
                        if ($i == 0){
                            $comentarios .= "<td>$info ";
                        }
                        else {
                            $comentarios .= "<tr><td></td><td>$info: ";
                        }
                    }
                    else {
                        $comentarios .= "$info</td></tr>";
                    }
                    $j++;
                }
            }
        }
        $comentarios = trim($comentarios, " ,\r\n");

        $boton = "<button onclick=\"location.href='cartelera.php?ingresarCom=true'\">Ingresar comentario</button><br><br>";
        if ($estadoComentario == true){
            $form_comentario = "<form action=\"\" method=\"post\">
                                <label for=\"user\">Texto:   </label>
                                <input size=\"100\" type=\"text\" name=\"comentario\" id=\"comentario\"><br><br>
                                <input type=\"submit\" name=\"comentar\" value=\"Enviar comentario\" class=\"btn btn-primary\"/><br/><br>
                                </form>
                                ";
        }
    }
 ?>

<button onclick="location.href='index.php'">Home</button><br><br>
<?php 
    if ($tipo == "cliente"){
        echo "<button onclick=\"location.href='logeado.php'\">Volver</button><br><br>";
    }
    else {
        echo "<button onclick=\"location.href='empleado.php'\">Volver</button><br><br>";
    }
 ?>

<form action="" method="post">
  <br><br><label for="user"> Películas:   </label>
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
    <p><input type="submit" name="submit" value="Mostrar Información" class="btn btn-primary"/><br/></p>
</form>
    <table cellspacing="10">
        <tr><td>Título:</td><td><?php  echo $titulo?></td></tr>
        <tr><td>Género:</td><td><?php  echo $genero?></td></tr>
        <tr><td>Clasificación:</td><td><?php  echo $clasificacion?></td></tr>
        <tr><td>Precio:</td><td><?php  echo $precio?></td></tr>
        <tr><td>Actores:</td><td><?php  echo $actores?></td></tr>
        <tr><td>Director:</td><td><?php  echo $directores?></td></tr>
        <?php  echo $comentarios?>
    </table>
    <?php 
        echo $boton ;
        echo $form_comentario;
    ?>
    <strong><?php echo $error ?></strong>


</body>
</html>