<header class="text">
  <a id="logo" href="principal.php"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscarconectado.php" method="GET" class="search">
    <label for="search">Buscar: </label><input id="search" class="text"name="busqueda" type="search" placeholder="Busqueda" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>
  </form>

  <div class="perfilF">
    <a href="menuperfil.php"><img id="perfil" src="images/perfil.jpg" alt="Editar perfil" /></a>
    <a href="menuperfil.php" id="perfilText">
      <?php
        if($_SESSION['remember']==true)
          $usuario=(String)$_SESSION['remember'];
        echo "<span>$usuario</span>";
      ?>
    </a>

    <a class="boton" href="index.php?q=logout">Desconectarse</a>
  </div>

</header>
