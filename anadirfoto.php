<?php
$title= "Añadir foto a album";
include("includes/head.php");
if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");


if(isset($_POST) && isset($_POST["titulo"]) && isset($_POST["fichero"]) && $_POST["titulo"]!="" && $_POST["fichero"]!=""){
  //Comprobamos los parametros
  $descripcion= $_POST['descripcion'];
  $titulo = $_POST['titulo'];
  $pais= $_POST['country'];
  $fichero = $_POST['fichero'];
  $freg= date("Y-m-d H:i:s");
  $album = $_POST["album"];

  if(isset($_POST['fecha']) && $_POST['fecha']!= ""){
    $fecha = $_POST['fecha'];
  }
  else {
    $fecha= date("Y-m-d");
  }
  //BEWARE SQL INJECTIONS
  $sentencia= "INSERT INTO fotos VALUES (NULL, '".$titulo."', '".$descripcion."','".$fecha."', ".$album.", $fichero, '".$freg."', ".$pais.")";
  //$resultado = mysqli_query($bbdd, $sentencia);
  echo("$sentencia");
  echo("<h3 class='index'> Inserción realizada </p></h3>");
}

if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Introduce los datos correctamente";
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
