<?php
  $title= "Imagen";
  include("includes/head.php");
  include("includes/headerC.php");

  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
	}


  if(isset($_GET)){
    if(isset($_GET['id'])){

      $resultado= mysqli_query($bbdd, 'SELECT * from fotos');
    }
  }
?>
  <main>
      <?php


      ?>
      <h2 id="titulo"><?php echo $titulo ?></h2>
      <h3 id="fecha">Fecha: <?php echo $fecha ?></h3>
      <figure id="detalleImg"><img  src="<?php  echo $src?>" alt="aproves"/></figure>
      <h3>Pais: Spoin</h3>

    <p>
      <h3>Albumes donde aparece</h3>
      <a href="">Album total </a>,<a href=""> Pompito</a>
    </p>

  </main>

  <?php include("includes/footer.php");?>
