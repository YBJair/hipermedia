<?php
  $title= "Pictures and Images";
  include("includes/head.php");
  include("includes/headerL.php");


  if(isset($_SESSION["remember"])==true){
		//header("location: principal.php");
	}
	if(isset($_GET["q"]) && $_GET["q"]=="login"){
		$pagina="l";
	}else if(isset($_GET["q"]) && $_GET["q"]=="registro"){
		$pagina="r";
	}else{
		$pagina="l";
	}
?>

<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<main>
  <!-- Resolucion: 250x167-->
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

</main>

<?php include("includes/footer.php");?>
