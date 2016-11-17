<?php
  $title= "Resultado busqueda";
  include("includes/head.php");
  include("includes/headerL.php");

  if(isset($_SESSION["remember"])==true){
    header("location: resultadoconectado.php");
  }

  if(isset($_GET)){
      $tituloget=$_GET["titulo"];
      $fechaget=$_GET["fecha"];
      $paisget=$_GET["pais"];

      $resultadopais = mysqli_query($bbdd, "SELECT NomPais FROM paises WHERE idPais=".$paisget);
      $filapais= $resultadopais->fetch_assoc();
      $nombrepais= $filapais['NomPais'];

      $resultado = mysqli_query($bbdd,"SELECT idFoto, Titulo, Fecha, Pais, Fichero FROM fotos WHERE Titulo LIKE '%$tituloget%' OR Fecha = $fechaget OR Pais = $paisget");
?>
<h1 class='index'>Resultado de la busqueda: <?php echo "$tituloget $fechaget $nombrepais" ; ?></h1>
<main>
  <?php
      while($fila=$resultado->fetch_assoc()){
        $id= $fila["idFoto"];
        $foto= $fila["Fichero"];
        $titulo= $fila["Titulo"];
        $fecha= $fila["Fecha"];
        $pais= $fila["Pais"];

        $resultadopais2 = mysqli_query($bbdd, "SELECT NomPais FROM paises WHERE idPais=".$pais);
        $filapais2= $resultadopais2->fetch_assoc();
        $nombrepais2= $filapais2['NomPais'];

        echo <<<HEREDOC
          <article>
            <a href="imagen.php?id=$id"><img src='$foto' alt='$titulo'/></a>
            <p>$titulo</p>
            <p>$fecha</p>
            <p>$nombrepais2</p>
          </article>
HEREDOC;
        }
      }
  ?>
</main>

<?php include("includes/footer.php");?>
