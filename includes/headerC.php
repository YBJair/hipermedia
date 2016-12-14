<header class="text">
  <a id="logo" href="principal.php"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscarconectado.php" method="GET" class="search">
    <label for="search">Buscar: </label><input id="search" class="text" name="busqueda" type="search" placeholder="Busqueda" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>
  </form>

  <?php

  $idUsu= $_SESSION["remember"];

  $comprobacion = "SELECT NomUsuario, Foto, Email FROM usuarios WHERE idUsuario=$idUsu";
  $result = mysqli_query($bbdd, $comprobacion);

  if($result!=false && !mysqli_error($bbdd)){
    $query = $result->fetch_assoc();

    $nombreUsu= $query['NomUsuario'];
    $emailUsu = $query['Email'];
    $fotoUsu= "images/perfil.jpg";

    if($query['Foto']!=null)
        $fotoUsu= "images/".$query['Foto'];

    $tipofoto= "";
    if(preg_match("/.gif/", $fotoUsu))
    $tipofoto="perfil2";

    $heredoc= <<<HEREDOC
<div class='perfilF'>
<a href='menuperfil.php'><img id="$tipofoto" src="$fotoUsu" alt='Foto perfil' title='Editar perfil'/></a>
<a href='menuperfil.php' id='perfilText'>
<span>$nombreUsu</span>
</a>

<a class='boton' href='index.php?q=logout'>Desconectarse</a>
</div>
HEREDOC;

    echo $heredoc;
  }
  ?>
</header>
