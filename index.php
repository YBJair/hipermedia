<?php
  $title= "Pictures and Images";
  include_once("includes/head.php");
  include_once("includes/headerL.php");
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

  $resultado= mysqli_query($bbdd, "select * from fotos order by FRegistro desc limit 5");

  
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
    $resultadopais = mysqli_query($bbdd, "SELECT NomPais FROM paises WHERE idPaises=".$pais);
    $filapais= $resultadopais->fetch_assoc();
    $nombrepais= $filapais['NomPais'];

      echo "<article>\n
                <a href='imagen.php?id=$id'><img src='$foto' alt='$titulo'/></a>\n
                <p>Titulo: $titulo</p>\n
                <p>Fecha: $fecha</p>\n
                <p>País: $nombrepais</p>\n
          </article>\n";
  }


  ?>
  <!-- Resolucion: 250x167-->
  <!--
  <article><a href="imagen.php"><img src="images/approves.gif" alt="snoop dog"/></a></article>
  <article><a href=""><img src="images/camion.gif" alt="camion"/></a></article>
  <article><a href=""><img src="images/zetta.gif" alt="gif de la compañia zetta"/></a></article>
  <article><a href=""><img src="images/trumpwall2.gif" alt="donnald trump"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
  -->
</main>

<?php include_once("includes/footer.php");?>
