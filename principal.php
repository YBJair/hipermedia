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
    $resultado= mysqli_query($bbdd, "SELECT f.Fichero, f.Titulo, f.Fecha, f.Pais, p.NomPais FROM fotos f, paises p WHERE f.Pais=p.idPais and f.idFoto =" .$id);
    while($fila = $resultado->fetch_assoc()){
        $foto= $fila ["Fichero"];
        $titulo= $fila ["Titulo"];
        $fecha= $fila ["Fecha"];
        $pais= $fila ["Pais"];
        $nombrepais= $fila["NomPais"];
        
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
  
  <h3> $nombrepais</h3>
  <p><b>Crítico: </b> $critico</p>
  <p><b>Comentario: </b> $coment</p>
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
