<?php
  $title= "Pictures and Images";
  include_once("includes/head.php");
  include_once("includes/headerL.php");
  if(isset($_GET["error"])){
    echo "<p style='text-align:right'>Introduce bien el usuario</p>";
  }
  //include_once("includes/bbddConexion.php");

  if(isset($_SESSION["remember"])==true){
		header("location: principal.php");
	}
	if(isset($_GET["q"]) && $_GET["q"]=="logout"){
    if(isset($_SESSION["remember"])){
       unset($_SESSION["remember"]);
       if(isset($_COOKIE["remember_user"])){
         setcookie("remember_user", "", time() -3600);
         setcookie("remember_pass", "", time() -3600);
         setcookie("remember_time", "", time() -3600);
       }
       header("location: index.php");
     }
	}
  $sentencia="SELECT idFoto, Fichero, Titulo, Fecha, Pais, NomPais FROM fotos, pais WHERE Pais=idPais ORDER BY FRegistro DESC LIMIT 5";
  $resultado= mysqli_query($bbdd, $sentencia);


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
    $nombrepais= $fila['NomPais'];

    //<!-- Resolucion: 250x167-->
    echo <<<HEREDOC
			<article>
        <a href="imagen.php?id=$id"><img src='$foto' alt='$titulo'/></a>
        <p>$titulo</p>
        <p>$fecha</p>
        <p>$nombrepais</p>
      </article>
HEREDOC;

  }

  ?>
</main>

<?php include_once("includes/footer.php");?>
