<?php
$title= "Añadir foto a album";
include("includes/head.php");
if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");


if(isset($_POST) && isset($_POST["titulo"]) && $_POST["titulo"]!="" && isset($_FILES["fichero"])){
  if($_FILES["fichero"]["error"]){
    header("location: menuperfil.php?error=0");
    exit;
  }
  else if(preg_match("/image\//", $_FILES["foto"]["type"])){
    //Comprobamos los parametros
    $descripcion= $_POST['descripcion'];
    $titulo = $_POST['titulo'];
    $pais= $_POST['country'];
    $freg= date("Y-m-d H:i:s");
    $album = $_POST["album"];

    if(isset($_POST['fecha']) && $_POST['fecha']!= ""){
      $fecha = $_POST['fecha'];
    }
    else {
      $fecha= date("Y-m-d");
    }


    include_once("includes/funciones.php");
    $foto = "images/".sanear_string($nombreUsu)."_".sanear_string($album)."_".time()."_".sanear_string($_FILES["fichero"]["name"]);
    if(@move_uploaded_file($_FILES["fichero"]["tmp_name"], "$foto")){
      //prepare ur anus
      $sentencia= "INSERT INTO fotos VALUES (NULL, '$titulo', '$descripcion','$fecha', $album, '$foto', '$freg', $pais)";
      $resultado = mysqli_query($bbdd, $sentencia);
      //echo("$sentencia");
      header("location: anadirfoto.php?success");
    }
  }
}


if (isset($_GET["success"])) {
$contenido = <<<REG
<div class="resultadoRegistro">
<h3>La foto se ha cambiado correctamente</h3>
</div>
REG;
echo $contenido;
}
if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Introduce los datos correctamente";
    break;
    case 1:
    echo "Se ha producido un error con la foto";
    break;
    default:
    echo "error desconocido";
    break;
  }
  echo "</h3>";
}
?>

<h1 class="index">Añadir foto a album</h1>
<main>
  <form action="anadirfoto.php" method="POST" enctype="multipart/form-data">
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
