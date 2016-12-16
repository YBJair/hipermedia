<?php
$title= "Pictures and Images";
include("includes/head.php");
include("includes/headerC.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
}

if(($fichero = @file(CRITICA)) == false){
  echo("No se pudo abrir el fichero");
} else {
    $crit = mt_rand(1,sizeof($fichero)-1);
    $linea = $fichero[$crit];
    $info = explode("<>",$linea);

    $id = $info[0];
    $critico = $info[1];
    $coment = $info[2];
    $sentencia = "SELECT f.Titulo, f.Fichero, f.Fecha, f.Album, p.NomPais, a.Titulo as TituloAlbum, u.NomUsuario, u.Foto 
          FROM fotos f, paises p , albumes a, usuarios u
          WHERE f.Pais=p.idPais and f.idFoto = $id and a.idAlbum = f.Album and u.idUsuario = a.Usuario";
    $resultado= mysqli_query($bbdd, $sentencia);
    if ($resultado!=false && $resultado->num_rows> 0){
        $fila = $resultado->fetch_assoc();
        $foto= $fila ["Fichero"];
        $titulo= $fila ["Titulo"];
        $fecha= $fila ["Fecha"];
        $nombrepais= $fila["NomPais"];
        $nomUsu = $fila["NomUsuario"];
        $titAlbum = $fila["TituloAlbum"];
        $idAlbum = $fila["Album"];
        $fotoUsu = $fila["Foto"];

        if($nombrepais==null){
      $nombrepais="Desconocido";
    }

    if($idAlbum==null){
      $titAlbum="No tiene album";
    }
    
        
    }
  }

?>
<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<?php
echo <<<HEREDOC
<main>
  <h2 id="titulo">$titulo</h2>
  <h3 id="fecha">Fecha: $fecha</h3>
  <p id="detalleImg">
      <a href='imagen.php?id=$id' ><img  width="70%"  src='$foto' alt='$titulo'/></a>
  </p> 
  <div class="propietarioImagen"><h3>Subido por: </h3> <p><img src="$fotoUsu" alt="foto de perfil"/><span>$nomUsu</span></p></div>
  <h3>Detalles</h3>

  <ul>
    <li><b>Pais:</b> $nombrepais</li>
    <li><b>Album:</b> <a href="album.php?id=$idAlbum">$titAlbum</a></li>
    <li><b>Crítico: </b> $critico</li>
    <li><b>Comentario: </b> $coment</li>
  </ul>
</main>
HEREDOC;
?>
<main>

  <?php
  $resultado= mysqli_query($bbdd, "SELECT idFoto, Fichero, Titulo, Fecha, Pais, NomPais FROM fotos, paises WHERE Pais=idPais ORDER BY FRegistro desc limit 5 ");
  while($fila=$resultado->fetch_assoc()){
    $id= $fila ["idFoto"];
    $foto= $fila ["Fichero"];
    $titulo= $fila ["Titulo"];
    $fecha= $fila ["Fecha"];
    $pais= $fila ["Pais"];
    $nombrepais= $fila["NomPais"];


    echo <<<HEREDOC
<article>
  <h3>$titulo</h3>
  <a href='imagen.php?id=$id'><img src='$foto' alt='$titulo'/></a>
  <p>$fecha</p>
  <p>$nombrepais</p>
</article>
HEREDOC;

  }

  ?>

</main>

<?php include("includes/footer.php");?>
