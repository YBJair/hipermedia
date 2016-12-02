<?php
$title= "Imagen";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");


if(isset($_GET)){
  if(isset($_GET['id'])){
    $id= $_GET['id'];

    $sentencia="SELECT f.Titulo, f.Fichero, f.Fecha, f.Album, NomPais, albumes.Titulo as TituloAlbum
    FROM fotos f, paises, albumes
    WHERE f.idFoto = $id AND f.Pais=paises.idPais AND albumes.idAlbum = f.Album";
    $resultado= mysqli_query($bbdd, $sentencia);

  }
}
?>
<main>
  <?php
  if ($resultado!=false && $resultado->num_rows> 0){
    $fila=$resultado->fetch_assoc();
    $titulo= $fila ["Titulo"];
    $foto= $fila ["Fichero"];
    $fecha= $fila ["Fecha"];
    $idalbum= $fila ["Album"];
    $nombrealbum= $fila["TituloAlbum"];
    $nombrepais= $fila ["NomPais"];

    if($nombrepais==null){
      $nombrepais="Desconocido";
    }

    if($idalbum==null){
      $nombrealbum="No tiene album";
    }

    echo <<<HEREDOC2
    <h2 id="titulo"> $titulo</h2>
    <h3 id="fecha">Fecha: $fecha</h3>
    <figure id="detalleImg"><img width="70%" src='$foto' alt='$titulo'/></figure>
    <h3>Pais: $nombrepais</h3>
    <p>
    <h3>Albumes donde aparece</h3>
    <a href="album.php?id=$idalbum">$nombrealbum</a>
    </p>
HEREDOC2;

  }
  else {
    echo "<h1> HTTP 404: FILE NOT FOUND</h1>\n";
  }
?>
</main>

<?php include("includes/footer.php");?>
