<header class="text">
  <a id="logo" href="principal.php"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscarconectado.php" method="GET" class="search">
    <label for="search">Buscar: </label><input id="search" class="text"name="busqueda" type="search" placeholder="Busqueda" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>
  </form>

  <?php

    $idUsu= $_SESSION["remember"];

    $sentencia = "SELECT NomUsuario, Foto, Email FROM usuarios WHERE idUsuario=$idUsu";
    $resultado = mysqli_query($bbdd, $sentencia);

    if($resultado!=false && !mysqli_error($bbdd)){
    $resultado = $resultado->fetch_assoc();
    $nombreUsu= $resultado['NomUsuario'];
    if($resultado['Foto']!=null)
      $fotoUsu= "images/".$resultado['Foto'];
    else {
      $fotoUsu= "images/perfil.jpg";
    }
    $emailUsu = $resultado['Email'];

    $tipofoto= "";
    if(preg_match("/.gif/", $fotoUsu))
      $tipofoto="perfil2";

    echo <<<HEREDOC
      <div class='perfilF'>
        <a href='menuperfil.php'><img id="$tipofoto" src="$fotoUsu" alt='Editar perfil' /></a>
        <a href='menuperfil.php' id='perfilText'>
          <span>$nombreUsu</span>
        </a>

        <a class='boton' href='index.php?q=logout'>Desconectarse</a>
      </div>
HEREDOC;
    }
  ?>
</header>
