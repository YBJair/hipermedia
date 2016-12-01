<?php
  $title= "Perfil";
  include("includes/head.php");
  include("includes/headerL.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
	}
?>

  <main>
    <h1>Pagina de Perfil</h1>
    <h2>Información Personal</h2>

    <?php
      if($_SESSION['remember']==true)
        $usuario=(String)$_SESSION['remember'];

      $resultado = mysqli_query($bbdd, "SELECT Email, Foto FROM usuarios WHERE NomUsuario='$usuario'");
      $fila = $resultado->fetch_assoc();
      $email=$fila['Email'];
      $src="images/".$fila['Foto'];
    ?>

    <form action="" method="POST">

      <?php
      echo <<<HEREDOC
      <p><label for="userName">Usuario: </label><!--<input id="userName" name="Nombre" type="text" placeholder="Suk Mike Hok" required/>-->$usuario </p>
      <p><label for="email">Email: </label><!--<input id="email" name="email" type="email" placeholder="example@gmail.com" required/>-->$email</p>
      <label for="imgP">Imagen de perfil: </label><!--<input id="imgP" name="img" type="file"/>--> <br/><img src="$src" alt="foto de perfil"/>
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

  <a href="#">Modificar datos</a>



  <h2>Albumes</h2>

  <ul>
    <li><a href="misalbumes.php">Mis Albumes</a></li>
    <li><a href="crearalbum.php">Crear Album</a></li>
    <li><a href="solalbum.php">Solicitar album</a></li>
    <li><a href="#">Darse de baja</a></li>
  </ul>

</main>

<?php include("includes/footer.php");?>
