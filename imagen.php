<?php
  $title= "Imagen";
  include("includes/head.php");
  include("includes/headerC.php");

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

  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
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
