<?php
$title= "Perfil";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}

include("includes/headerC.php");

?>
<a class='boton' href='menuperfil.php'><i class="material-icons">arrow_back</i>Volver</a>
<main>
  <h1>Mis Albumes</h1>
  <ol>

  <?php
  $sentencia = "SELECT idAlbum, Titulo, Descripcion FROM albumes a WHERE a.Usuario=$idUsu";
  $resultado = mysqli_query($bbdd, $sentencia);

  if($resultado!=false && !mysqli_error($bbdd)){
    while($fila=$resultado->fetch_assoc()){
      $idalbum= $fila["idAlbum"];
      $tituloAlbum= $fila["Titulo"];
      $descripcionAlbum= "Descripción: ".$fila["Descripcion"];
      if($fila["Descripcion"]==null)
      $descripcionAlbum="No tiene descripción";

      $html = <<<HTML
<li>
<a href="album.php?id=$idalbum">$tituloAlbum</a>
<br/>
<p>$descripcionAlbum</p>
</li>
HTML;
      echo $html;
    }
  }
  ?>
</ol>

  <hr/>

</main>

<?php include("includes/footer.php");?>
