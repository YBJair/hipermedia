<?php
$title= "Perfil";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}

include("includes/headerC.php");

if(isset($_POST["nombre"])){
  $user   = $_POST["nombre"];
  $pass   = $_POST["pass"];
  $email  = $_POST["email"];
  $sexo   = $_POST["sexo"];
  $fecha  = $_POST["fecha"];
  $ciudad = $_POST["ciudad"];
  $pais   = $_POST["pais"];

  $sentencia = "UPDATE Usuarios u SET NomUsuario = '".$user."', Clave = '".$pass."', Email = '".$email."', Sexo = ".$sexo.", FNacimiento =".$fecha.",
  Ciudad = '".$ciudad."', Pais = ".$pais."  where u.idUsuario = ".$idUsu ;
  $resultado = mysqli_query($bbdd,$sentencia);
  echo ("<p class= registro>Cambios guardados</p>");
}

//BORRAR FOTO
if(isset($_POST["borrar"])){
    if(!preg_match("/perfil.jpg/", $fotoUsu)){
      $sentencia = "UPDATE Usuarios u SET Foto = 'perfil.jpg' WHERE u.idUsuario = $idUsu";
      $resultado = mysqli_query($bbdd,$sentencia);
      unlink($fotoUsu);
    }
  echo ("<p class= registro>Imagen borrada</p>");
  header("location: menuperfil.php?success=1");

}

//MODIFICAR FOTO
if(isset($_FILES["foto"])){
  if($_FILES["foto"]["error"]){
    header("location: menuperfil.php?error=0");
    exit;
  }
  else{

    include_once("includes/funciones.php");
    $foto = sanear_string($nombreUsu)."_".time()."_".sanear_string($_FILES["foto"]["name"]);
    if(@move_uploaded_file($_FILES["foto"]["tmp_name"], "images/$foto")){
      if(!preg_match("/perfil.jpg/", $fotoUsu))
        unlink($fotoUsu);
      $fotoUsu= $foto;
      $registro = "UPDATE usuarios SET Foto='$foto' WHERE idUsuario=$idUsu";
      $resultado= mysqli_query($bbdd, $registro);
    }
  }
  sleep(1);
  header("location: menuperfil.php?success=0");
}
if (isset($_GET["success"])) {
  if($_GET["success"] == 0){
      $contenido = <<<REG
      <div class="resultadoRegistro">
      <h3>La foto se ha cambiado correctamente</h3>
      </div>
REG;
  } else if($_GET["success"] == 1){
    $contenido = <<<REG
      <div class="resultadoRegistro">
      <h3>La foto se ha borrado correctamente</h3>
      </div>
REG;
  }
echo $contenido;
  
}

if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Selecciona una foto para modificarla";
    break;
    default:
    echo "error desconocido";
    break;
  }
  echo "</h3>";
}
?>
<a class='boton' href='principal.php'><i class="material-icons">arrow_back</i>Volver</a>
<main>
  <h1 >Pagina de Perfil</h1>
  <h2>Información Personal</h2>


  <?php
  $html = <<<HTML
<p>Usuario: $nombreUsu </p>
<p>Email: $emailUsu</p>
Imagen de perfil: <br/><img src="$fotoUsu" width="10%" alt="foto de perfil"/>
HTML;
  echo $html;
  ?>
  <form action="menuperfil.php" method="POST" enctype="multipart/form-data">
    <p><input type="file" name="foto"></p>
    <button type="submit">Modificar foto</button>
  </form>
  <form action="menuperfil.php" method="POST">
    <button type="submit" name ="borrar" value="true">Borrar foto</button>
  </form>
  <hr/>
  <form action="perfilModificar.php">
    <button type="submit" name="button">Modificar datos</button>
  </form>
  <form action="bajaUsuario.php">
    <button type="submit" name="button">Darse de baja</button>
  </form>

  <h2>Albumes</h2>

  <ul>
    <li><a href="misalbumes.php">Mis Albumes</a></li>
    <li><a href="crearalbum.php">Crear Album</a></li>
    <li><a href="anadirfoto.php">Añadir foto a album</a></li>
    <li><a href="solalbum.php">Solicitar album</a></li>

  </ul>

</main>
<?php include("includes/footer.php");?>
