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

    $sentencia="SELECT Titulo, Fecha, Usuario, NomPais FROM albumes, paises WHERE Pais=idPais AND idAlbum =$id";
    $resultado= mysqli_query($bbdd, $sentencia);
  }
}
?>
<main>
  <?php
  if ($resultado!=false && $resultado->num_rows> 0){
    if($fila=$resultado->fetch_assoc()){
      $titulo= $fila ["Titulo"];
      $fecha= $fila ["Fecha"];
      $nombrepais= $fila["NomPais"];

      $resultadofoto= mysqli_query($bbdd, "SELECT Titulo, Fichero, idFoto FROM fotos WHERE Album=".$id);


      $html= <<<HTML
<h2 id='titulo'> $titulo</h2>
<h3 id='fecha'>Fecha: $fecha</h3>
HTML;

      echo $html;

      $nfotos=0;
      while($filafoto=$resultadofoto->fetch_assoc()){
        $fotof=$filafoto['Fichero'];
        $titulof=$filafoto['Titulo'];
        $idFoto= $filafoto['idFoto'];

        $html2 = <<<HTML2
\n<h3>$titulof</h3>
<figure id='detalleImg'><a href="imagen.php?id=$idFoto"><img width='70%' src='$fotof' alt='$titulof'/></a></figure>
HTML2;

        echo $html2;
        $nfotos++;
      }
      if($nfotos===0){
        echo "<h1 class='index'>No hay fotos</h1>";
      }
      echo "\n<h3>Pais: $nombrepais</h3>\n";
    }
  }
  else{
      echo "<h1> Error 404: Album no encontrado</h1>\n";
  }
  ?>
</main>

<?php include("includes/footer.php");?>
