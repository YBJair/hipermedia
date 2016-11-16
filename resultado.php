<?php
  $title= "Resultado busqueda";
  include("includes/head.php");
  include("includes/headerL.php");

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
    header("location: resultadoconectado.php");
  }

  if(isset($_GET)){
    if(isset($_GET["titulo"])){
      $titulo=$_GET["titulo"];
    }
    if(isset($_GET["fecha"])){
      $fecha=$_GET["fecha"];
    }
    if(isset($_GET["pais"])){
      $pais=$_GET["pais"];
    }
  }
?>
<h1 class='index'>Resultado de la busqueda: <?php echo "$titulo $fecha $pais" ; ?></h1>
<main>
  <?php
        
     
        $sentencia = 'SELECT titulo, fecha, pais, fichero from fotos where titulo = $titulo and fecha = $fecha and pais = $pais ';
        for($i = 0; $i < mysqli_num_rows ; $i++){
          
             $j = $i++;
             $k = $j++;
             $l = $k++;
             $foto = mysqli_query($bbdd,$sentencia);
             $foto = mysqli_fetch_array($nombre,MYSQLI_NUM);
             echo "<article>\n
                  <h2>$foto[$i]</h2>\n
                  <figure><a href=imagen.php><img src=images/$foto[$l] /></a></figure>\n
                  <p>$foto[$k]</p>\n
                  <p>$foto[$j]</p>\n";

                  $i += 3;
        }

  ?>

  <!--<article>
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
  </article>-->
</main>

<?php include("includes/footer.php");?>
