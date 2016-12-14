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

    $sentencia="SELECT f.Titulo, f.Fichero, f.Fecha, f.Album, NomPais, a.Titulo as TituloAlbum, u.NomUsuario, u.Foto
    FROM fotos f, paises, albumes a, usuarios u
    WHERE f.idFoto = $id AND f.Pais=paises.idPais AND a.idAlbum = f.Album AND u.idUsuario = a.Usuario";
    //echo $sentencia;
    $resultado= mysqli_query($bbdd, $sentencia);

  }
}


?>
<a class='boton' href='principal.php'><i class="material-icons">arrow_back</i>Volver</a>
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
    $nombrepropietario = $fila["NomUsuario"];
    $fotopropietario = "images/".$fila["Foto"];

    if($nombrepais==null){
      $nombrepais="Desconocido";
    }

    if($idalbum==null){
      $nombrealbum="No tiene album";
    }

    $contenido = <<<HTML
<h2 id="titulo"> $titulo</h2>
<h3 id="fecha">Fecha: $fecha</h3>
<figure id="detalleImg"><img width="70%" src='$foto' alt='$titulo'/></figure>

<div class="propietarioImagen"><p>Subido por: </p> <p><img src="$fotopropietario" alt="foto de perfil"/><span>$nombrepropietario</span></p></div>

<h3>Detalles</h3>
<ul>
  <li>Pais: $nombrepais</li>
  <li>Album: <a href="album.php?id=$idalbum">$nombrealbum</a></li>
</ul>

HTML;

    echo $contenido;


  }
  else {
    echo "<h1> Error 404: Imagen no encontrada</h1>\n";
  }
?>
<span></span>
<h3></h3>
</main>

<?php include("includes/footer.php");?>
