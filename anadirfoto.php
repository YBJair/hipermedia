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
  $descripcion= $_POST['descripcion'];
  $titulo = $_POST['titulo'];
  $pais= $_POST['country'];
  $freg= date("Y-m-d H:i:s");
  $album = $_POST["album"];

  if(isset($_POST['fecha'])){
    $fecha = $_POST['fecha'];
  }
  else {
    $fecha= date("Y-m-d");
  }
  //BEWARE SQL INJECTIONS
  $sentencia= "INSERT INTO fotos VALUES (NULL, '".$titulo."', '".$descripcion."','".$fecha."', ".$album.", null, '".$freg."', ".$pais.")";
  $resultado = mysqli_query($bbdd, $sentencia);
  echo("<p class=registro> Inserción realizada </p>");
}
?>

<h1 class="index">Añadir foto a album</h1>
<main>
  <form action="anadirfoto.php" method="POST">
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
