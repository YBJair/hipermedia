<?php
$title= "Pictures and Images";
include("includes/head.php");
include("includes/headerC.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
}

$resultado= mysqli_query($bbdd, "SELECT idFoto, Fichero, Titulo, Fecha, Pais, NomPais FROM fotos, paises WHERE Pais=idPais ORDER BY FRegistro desc limit 5 ");
?>
<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<main>

  <?php
  while($fila=$resultado->fetch_assoc()){
    $id= $fila ["idFoto"];
    $foto= $fila ["Fichero"];
    $titulo= $fila ["Titulo"];
    $fecha= $fila ["Fecha"];
    $pais= $fila ["Pais"];
    $nombrepais= $fila["NomPais"];


    echo <<<HEREDOC
      <article>
        <a href='imagen.php?id=$id'><img src='$foto' alt='$titulo'/></a>
        <p>$titulo</p>
        <p>$fecha</p>
        <p>$nombrepais</p>
      </article>
HEREDOC;

  }

  ?>

</main>

<?php include("includes/footer.php");?>
