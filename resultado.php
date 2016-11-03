<?php
  $title= "Resultado busqueda";
  include("includes/head.php");
  include("includes/headerL.php");



  if(isset($_GET)){
    if(isset($_GET["titulo"])){
      $titulo=$_GET["titulo"];
    }
  }
?>
<h1 class='index'>Resultado de la busqueda: <?php echo $titulo; ?></h1>
<main>
  <article>
    <h2>Approves</h2>
    <figure><a href="imagen.php"><img src="images/approves.gif" alt="meh"  /></a></figure>
    <p>08/04/1994</p>
    <p>Spoin</p>
  </article>
  <article>
    <h2>Decorasiao</h2>
    <figure><a href=""><img src="images/dormitorio.jpg" alt="meh"  /></a></figure>
    <p>31/02/2054</p>
    <p>Meh</p>
  </article>
</main>

<?php include("includes/footer.php");?>
