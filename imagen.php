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
      $resultado= mysqli_query($bbdd, "SELECT * FROM fotos WHERE idFoto =".$id);

        $fila=$resultado->fetch_assoc();
        if($fila["Fichero"] != ""){
          $foto= $fila ["Fichero"];
          $titulo= $fila ["Titulo"];
          $fecha= $fila ["Fecha"];
          $pais= $fila ["Pais"];
          $idalbum= $fila ["Album"];

          if($pais!=null){
            $resultadopais = mysqli_query($bbdd, "SELECT NomPais FROM paises WHERE idPais=".$pais);
            $filapais= $resultadopais->fetch_assoc();
            $nombrepais= $filapais['NomPais'];
          }else{
            $pais="Desconocido";
          }

          if($idalbum!=null){
            $resultadoalbum = mysqli_query($bbdd, "SELECT Titulo FROM albumes WHERE idAlbum=".$idalbum);
            $filaalbum= $resultadoalbum->fetch_assoc();
            $nombrealbum= $filaalbum['Titulo'];
          }
        } else {
          $fila = null;
        }

    }
  }
?>
  <main>
    <?php

    if($fila != null){
      echo <<<HEREDOC
        <h2 id="titulo"> $titulo</h2>
        <h3 id="fecha">Fecha: $fecha</h3>
        <figure id="detalleImg"><img width="70%" src='$foto' alt='$titulo'/></figure>
        <h3>Pais: $nombrepais</h3>
        <p>
HEREDOC;
          if($idalbum!=null){
            echo "<h3>Albumes donde aparece</h3>";
            echo "<a href='album.php?id=$idalbum'>$nombrealbum</a>";
          }else{
            echo "<h3>No está en ningún album</h3>";
          }
        echo "</p>";
    } else {
      echo "<h1> HTTP 404: FILE NOT FOUND</h1>\n";
    }
    ?>
  </main>

  <?php include("includes/footer.php");?>
