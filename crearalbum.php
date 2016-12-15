<?php
$title= "Crear Album";
include("includes/head.php");
if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");


if(isset($_POST) && isset($_POST["titulo"])){
  //Comprobamos los parametros
  $descripcion= $_POST['descripcion'];
  $titulo = $_POST['titulo'];
  $pais= $_POST['country'];
  if(isset($_POST['fecha']) && $_POST['fecha']=""){
    $fecha = $_POST['fecha'];
  }
  else {
    $fecha= date("Y-m-d");
  }
  //BEWARE SQL INJECTIONS
  $sentencia= "INSERT INTO albumes VALUES (NULL, '$titulo', '$descripcion', '$fecha', $pais, $idUsu)";
  $resultado = mysqli_query($bbdd, $sentencia);
  echo("<p class=registro> Álbum creado</p>");
}
?>

<h1 class="index">Crear Album</h1>
<main>
  <form action="crearalbum.php" method="POST">
    <p><label for="title">Titulo: </label><input id="title" name="titulo" type="text" required/></p>
    <p>
      <label for="descripcion">Descripción: </label><input id="descripcion" type="text" name="descripcion" placeholder="descripcion">
    </p>
    <p>
      <label for="date">Fecha: </label><input id="date" type="date" name="fecha">
    </p>
    <p>
      <label for="country">Pais: </label>
      <select id="country" name="country">
        <?php
        include_once("includes/paises.php");
        ?>
      </select>
    </p>

    <input type="submit" value="Crear" class="boton"/>
  </form>
</main>

<?php include("includes/footer.php");?>
