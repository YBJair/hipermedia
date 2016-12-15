<?php
$title= "Resultado busqueda";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");

if(isset($_GET) && isset($_GET["titulo"]) && isset($_GET["fecha"]) && isset($_GET["pais"])){
  $tituloget=$_GET["titulo"];
  $paisget=$_GET["pais"];
  if(isset($_GEt["fecha"]))
    $fechaget=$_GET["fecha"];
  else $fechaget= date("Y-m-d");

  $sentencia="SELECT idFoto, Fichero, Titulo, Fecha, p1.NomPais, p2.NomPais as NomPaisGet
  FROM fotos, paises p1, paises p2 WHERE p1.idPais=$paisget AND p1.idPais=p2.idPais AND p2.idPais=$paisget AND (Titulo LIKE '%$tituloget%')
  UNION SELECT idFoto, Fichero, Titulo, Fecha, p1.NomPais, p2.NomPais as NompaisGet
  FROM fotos, paises p1, paises p2 WHERE p1.idPais=$paisget AND p1.idPais=p2.idPais AND p2.idPais=$paisget AND (Fecha=$fechaget OR Pais=p1.idPais)
  UNION SELECT idFoto, Fichero, Titulo, Fecha, p1.NomPais, p2.NomPais as NompaisGet
  FROM fotos, paises p1, paises p2 WHERE p1.idPais=$paisget AND p1.idPais=p2.idPais AND p2.idPais=$paisget AND (Pais=p1.idPais)
  ";
  $resultado = mysqli_query($bbdd, $sentencia);

  $fila= $resultado->fetch_assoc();
  $nombrepais= $fila['NomPaisGet'];


  ?>
  <h1 class='index'>Resultado de la busqueda: <?php echo "$tituloget | $fechaget | $nombrepais" ; ?></h1>
  <main>
    <?php
    while($fila!=false){
      $id= $fila["idFoto"];
      $foto= $fila["Fichero"];
      $titulo= $fila["Titulo"];
      $fecha= $fila["Fecha"];
      $nombrepais2= $fila["NomPais"];

      $html= <<<HTML
<article>
<a href="imagen.php?id=$id"><img src='$foto' alt='$titulo'/></a>
<p>$titulo</p>
<p>$fecha</p>
<p>$nombrepais2</p>
</article>
HTML;
      echo $html;
      $fila=$resultado->fetch_assoc();
    }
  }else{
    if(isset($_GET)){
      $tituloget="";
      $fechaget="";
      $nombrepais="";
      if(isset($_GET["titulo"]))
      $tituloget=$_GET["titulo"];
      if(isset($_GET["fecha"]))
      $fechaget=$_GET["fecha"];
      if(isset($_GET["pais"]))
      $nombrepais=$_GET["pais"];
    }

  ?>
  <h1 class='index'>Resultado de la busqueda: <?php echo "$tituloget | $fechaget | $nombrepais" ; ?></h1>
  <main>
    <h2>Inserta los parámetros correctamente</h2>
  <?php } ?>
  </main>

  <?php include("includes/footer.php");?>
