<?php
  $title= "Respuesta Album";
  include("includes/head.php");

  if(isset($_SESSION["remember"])==false || !isset($_POST["name"])){
		header("location: index.php");
    exit;
  }
  include("includes/headerC.php");

  $nombre = $_POST["name"];
  $titulo  = $_POST["title"];
  $email  = $_POST["email"];
  $descr = $_POST["addtext"];
  $album = $_POST["album"];
  $direc = $_POST["street"]." ".$_POST["city"]." ".$_POST["cp"]." ".$_POST["province"];
  $copias = $_POST["numcopies"];
  $resol = $_POST["resolution"];
  //Para fecha
  $fecha = $_POST["receip"];
  $color = $_POST["color"];
  //icolor
  if($_POST["colorprint"] == "color") $icolor = true;
  else $icolor = false;
  $freg = date("Y-m-d H:i:s");
  //Para coste
  $ppi = 0;
  if($copias < 5) $cpp = 0.1;
  else if($copias > 4 && $copias <11) $cpp = 0.08;
  else $cpp = 0.07;
  if($resol > 300) $ppi = 0.02;
  if($icolor == true) $ppi = $ppi + 0.05;
  $sentencia = "SELECT idFoto from fotos where Album = ".$album;
  $imagenes = mysqli_query($bbdd,$sentencia);
  $numimagenes = $imagenes->num_rows;
  $coste = $cpp * $copias + $numimagenes * $ppi;  

  $sentencia = "INSERT INTO solicitudes VALUES (null, ".$album.", '".$nombre."', '".$titulo."', '".$descr."', 
      '".$email."', '".$direc."','".$color."', ".$copias.", ".$resol.", '".$fecha."', ".$icolor.", '".$freg."', ".$coste.")";
  $resultado = mysqli_query($bbdd,$sentencia);
?>
  <main>
    <p> La petición ha sido aceptada. El coste total es de <?php echo($coste); ?>€ </p>
  </main>

<? include("includes/footer.php");
