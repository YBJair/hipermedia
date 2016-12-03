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

    $sentencia = "UPDATE Usuarios SET NomUsuario = '$user', Clave = '$pass', Email = '$email', Sexo = $sexo, FNacimiento ='$fecha'
        Ciudad = '$ciudad', Pais = $pais  ";
    $resultado = mysqli_fetch($bbdd,$sentencia);
    echo ("<p>Cambios guardados</p>");
  }
?>
  <a class='boton' href='principal.php'><i class="material-icons">arrow_back</i>Volver</a>
  <main>
    <h1>Pagina de Perfil</h1>
    <h2>Información Personal</h2>

    <?php
      $resultado = mysqli_query($bbdd, "SELECT NomUsuario, Email, Foto FROM usuarios WHERE idUsuario='$idUsu'");
    ?>

    <form action="" method="POST">

      <?php
      echo <<<HEREDOC
      <p><label for="userName">Usuario: </label><!--<input id="userName" name="Nombre" type="text" placeholder="Suk Mike Hok" required/>-->$nombreUsu </p>
      <p><label for="email">Email: </label><!--<input id="email" name="email" type="email" placeholder="example@gmail.com" required/>-->$emailUsu</p>
      <label for="imgP">Imagen de perfil: </label><!--<input id="imgP" name="img" type="file"/>--> <br/><img src="$fotoUsu" alt="foto de perfil"/>
HEREDOC;
      ?>

      <!--<button type="submit" name="button">Guardar</button>-->
      <hr>
    </form>
    <!--<form class="" action="index.php" method="post">
    <p><label for="password">Nueva Contraseña: </label><input id="password" name="Pass" type="password" required/>
    <label for="confirm">Confirmar contraseña</label><input id="confirm" name="confirm" type="password" required/></p>
    <button type="submit" name="button">Guardar</button>
  </form>-->

  <a href="perfilModificar.php">Modificar datos</a>



  <h2>Albumes</h2>

  <ul>
    <li><a href="misalbumes.php">Mis Albumes</a></li>
    <li><a href="crearalbum.php">Crear Album</a></li>
    <li><a href="solalbum.php">Solicitar album</a></li>
    <li><a href="#">Darse de baja</a></li>
  </ul>

</main>

<?php include("includes/footer.php");?>
