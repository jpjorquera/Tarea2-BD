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
    if (empty($_GET['modificarPel'])){
        $estadoPelicula=false;
    }
    else {
        $estadoPelicula=$_GET['modificarPel'];
    }
    $usuario = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $boton = "";
    $boton2 = "";
    $form_comentario = "";
    $form_pelicula = "";
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
    if (!empty($_POST['modificar'])){
        if (isset($_POST['modificar'])) {
            $titulo = $_POST['titulo'];
            $genero = $_POST['genero'];
            $clasificacion = $_POST['clasificacion'];
            $precio = $_POST['precio'];
            $actores = $_POST['actores'];
            $director = $_POST['directores'];
            $actual = $_SESSION['peli_actual'];
            $modified = false;
            if ($titulo != ""){
                echo "Cambie titulo";
                //$query = "UPDATE PELICULA 
                  //  SET titulo = '$titulo
                    //WHERE id_pelicula = $actual";
                //echo $query;
                $result = mysqli_query($db, "UPDATE PELICULA 
                    SET titulo = '$titulo'
                    WHERE id_pelicula = $actual");
                $modified = true;
            }
            if ($genero != ""){
                echo "Cambie genero";
                $result = mysqli_query($db, "UPDATE PELICULA 
                    SET genero = '$genero'
                    WHERE id_pelicula = $actual");
                $modified = true;
            }
            if ($clasificacion != ""){
                echo "Cambie clasificacion";
                $result = mysqli_query($db, "UPDATE PELICULA 
                    SET clasificacion = '$clasificacion'
                    WHERE id_pelicula = $actual");
                $modified = true;
            }
            if ($precio != ""){
                echo "Cambie precio";
                $result = mysqli_query($db, "UPDATE PELICULA 
                    SET precio = $precio
                    WHERE id_pelicula = $actual");
                $modified = true;
            }
            if ($actores != ""){
                echo "Agregue actores";
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
                       ( '$act', '$actual' );");
                }
                $modified = true;
            }
            if ($director != ""){
                echo "Agregue director";
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
                           ( '$dir', '$actual' );");
                }
            }
            if ($modified){
                $error = "Película actualizada";
            }
            else {
                $error = "Por favor ingrese información para modificar";
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
	if(isset($_POST['submit']) or ($estadoComentario == true) or ($estadoPelicula == true)) {
        if (isset($_POST['submit'])) {
            $estadoComentario = false;
            $estadoPelicula = false;
        }
        if ($estadoComentario == false && $estadoPelicula == false){
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
                            $comentarios .= "<tr><td></td><td>$info ";
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

        $boton = "<button onclick=\"location.href='cartelera.php?ingresarCom=true'\">Ingresar comentario</button> &nbsp &nbsp";
        if ($tipo != "cliente"){
            $boton2 = "<button onclick=\"location.href='cartelera.php?modificarPel=true'\">Modificar Película</button>";
        }
        if ($estadoComentario == true){
            $form_comentario = "<br><br><form action=\"\" method=\"post\">
                                <label for=\"user\">Texto:   </label>
                                <input size=\"70\" type=\"text\" name=\"comentario\" id=\"comentario\"><br><br>
                                <input type=\"submit\" name=\"comentar\" value=\"Enviar comentario\" class=\"btn btn-primary\"/><br/><br>
                                </form>
                                ";
        }
        if ($estadoPelicula == true){
            $form_pelicula = "<br><br><form action=\"\" method=\"post\">
                                <label for=\"user\">Título:   </label>
                                <input type=\"text\" name=\"titulo\" id=\"titulo\"><br><br>
                                <label for=\"user\">Género:   </label>
                                <input type=\"text\" name=\"genero\" id=\"genero\"><br><br>
                                <label for=\"user\">Clasificación:   </label>
                                <input type=\"text\" name=\"clasificacion\" id=\"clasificacion\"><br><br>
                                <label for=\"user\">Precio:   </label>
                                <input type=\"text\" name=\"precio\" id=\"precio\"><br><br>
                                <label for=\"user\">Agregar actores:   </label>
                                <input size=\"60\" type=\"text\" name=\"actores\" id=\"actores\"><br><br>
                                <label for=\"user\">Agregar directores:   </label>
                                <input size=\"60\" type=\"text\" name=\"directores\" id=\"directores\"><br><br>
                                <input type=\"submit\" name=\"modificar\" value=\"Modificar\" class=\"btn btn-primary\"/><br/><br>
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
        echo $boton2;
        echo $form_comentario;
        echo $form_pelicula;
    ?>
    <strong><?php echo $error ?></strong>


</body>
</html>