<header class="text">
  <a id="logo" href="principal.php"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscarconectado.php" method="GET" class="search">
    <label for="search">Buscar: </label><input id="search" class="text"name="busqueda" type="search" placeholder="Busqueda" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>
  </form>

  <?php
    //if(!isset($_SESSION["remember"]));

    $idUsu= $_SESSION["remember"];
    $sentencia = "SELECT NomUsuario, Foto, Email FROM usuarios WHERE idUsuario=$idUsu";
    $resultado = mysqli_query($bbdd, $sentencia);
    $resultado = $resultado->fetch_assoc();
    $nombreUsu= $resultado['NomUsuario'];
    $fotoUsu= "images/".$resultado['Foto'];
    $emailUsu = $resultado['Email'];

  ?>

  <div class="perfilF">
    <a href="menuperfil.php"><img id="perfil" src="<?php echo ($fotoUsu);?>" alt="Editar perfil" /></a>
    <a href="menuperfil.php" id="perfilText">
      <?php
        echo "<span>$nombreUsu</span>";

      ?>
    </a>

    <a class="boton" href="index.php?q=logout">Desconectarse</a>
  </div>

</header>
