<?php
  $title= "Pictures and Images";
  include_once("includes/head.php");
  include_once("includes/headerL.php");
  //include_once("includes/bbddConexion.php");

  $bbdd = @mysqli_connect(
          'localhost', //server
          'user', 
          'root',
          'pibd'  //bbdd
        );
        if(!$bbdd){
          echo '<p> Error en base de datos: ' . mysqli_connect_error();
          echo '</p>';
          exit;
        }

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
?>

<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<main>
  <!-- Resolucion: 250x167-->

  <?php 
  for($i = 0; $i < 5; $i++){

     $sentencia = 'SELECT Titulo from Fotos f order by FRegistro asc limit 1 offset $i';
     $titulo = mysqli_query($bbdd,$sentencia);

     $sentencia = 'SELECT Fichero from Fotos f order by FRegistro asc limit 1 offset $i';
     $foto = mysqli_query($bbdd,$sentencia);

     $sentencia = 'SELECT Fecha from Fotos f order by FRegistro asc limit 1 offset $i';
     $fecha = mysqli_query($bbdd,$sentencia);

     $sentencia = 'SELECT Pais from Fotos f order by FRegistro asc limit 1 offset $i';
     $pais = mysqli_query($bbdd,$sentencia);

     /*$sentencia = 'SELECT IdFoto from Fotos f order by FRegistro asc limit 1 offset $i';
     $id = mysql_query($bbdd,$sentencia);*/

     echo "<article>\n
                <a href=$foto><img src=$foto alt=$titulo/></a>\n
                <p>Titulo: $titulo</p>\n
                <p>Fecha: $date</p>\n
                <p>País: $pais</p>\n
          </article>\n";
  }

  
  ?>

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
