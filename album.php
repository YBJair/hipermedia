<?php
  $title= "Imagen";
  include("includes/head.php");
  include("includes/headerC.php");

  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
	}


  if(isset($_GET)){
    if(isset($_GET['id'])){
      $id= $_GET['id'];
      $resultado= mysqli_query($bbdd, "SELECT Titulo, Fecha, Pais, Usuario FROM albumes WHERE idAlbum =".$id);

      if($fila=$resultado->fetch_assoc()){
        $titulo= $fila ["Titulo"];
        $fecha= $fila ["Fecha"];
        $pais= $fila ["Pais"];

        if($pais!=null){
          $resultadopais = mysqli_query($bbdd, "SELECT NomPais FROM paises WHERE idPais=".$pais);
          $filapais= $resultadopais->fetch_assoc();
          $nombrepais= $filapais['NomPais'];
        }else{
          $pais="Desconocido";
        }

        $resultadofoto= mysqli_query($bbdd, "SELECT Titulo, Fichero FROM fotos WHERE Album=".$id);
      }

    }
  }
?>
  <main>
    <?php
      echo <<<HEREDOC
        <h2 id='titulo'> $titulo</h2>
        <h3 id='fecha'>Fecha: $fecha</h3>
HEREDOC;
      $nfotos=0;
      while($filafoto=$resultadofoto->fetch_assoc()){
        $foto=$filafoto['Fichero'];
        $titulo=$filafoto['Titulo'];

        echo "<figure id='detalleImg'><img width='70%' src='$foto' alt='$titulo'/></figure>";
        $nfotos++;
      }
      if($nfotos===0){
        echo "<h1 class='index'>No hay fotos</h1>";
      }
      echo "<h3>Pais: $nombrepais</h3>\n
      <p>";


      echo "</p>";
    ?>
  </main>

  <?php include("includes/footer.php");?>
