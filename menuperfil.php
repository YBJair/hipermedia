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
?>
  <a class='boton' href='principal.php'><i class="material-icons">arrow_back</i>Volver</a>
  <main>
    <h1 >Pagina de Perfil</h1>
    <h2>Información Personal</h2>


      <?php
      $html = <<<HTML
<p>Usuario: $nombreUsu </p>
<p>Email: $emailUsu</p>
Imagen de perfil: <br/><img src="$fotoUsu" alt="foto de perfil"/>
HTML;
      echo $html;
      ?>
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
