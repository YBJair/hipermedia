<?php
$title= "Añadir foto a album";
include("includes/head.php");
if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");


if(isset($_POST) && isset($_POST["titulo"])){
  //Comprobamos los parametros
  $descripcion= $_POST['titulo'];
  $titulo = $_POST['titulo'];
  $pais= $_POST['pais'];
  $fechaRegistro= date("Y-m-d H:i:s");

  if(isset($_POST['fecha'])){
    $fecha = $_POST['fecha'];
  }
  else {
    $fechaRegistro= date("Y-m-d H:i:s");
  }
  //BEWARE SQL INJECTIONS
  //$sentencia= "INSERT INTO albumes VALUES (NULL, $titulo, $descripcion, $pais, $idUsu)";
  //$resultado = mysqli_query($bbdd, $sentencia);

}
?>

<h1 class="index">Añadir foto a album</h1>
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
      <label for="album">Album: </label>
      <select id="album" name="album">

        <?php
          include_once("includes/albumes.php");
        ?>
      </select>
    </p>
    <p>
      <label for="fichero">Imagen: </label><input id="fichero" type="file" name="fichero">
    </p>
    <p>
      <label for="country">Pais: </label>
      <select id="country" name="country">
        <?php
        include_once("includes/paises.php");
        ?>
      </select>
    </p>

    <input type="submit" value="Añadir" class="boton"/>
  </form>
</main>

<?php include("includes/footer.php");?>
