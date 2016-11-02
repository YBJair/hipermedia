<?php

?>

<header class="text">
  <a href="index.php" id="logo"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscar.php" method="POST" class="search">

    <label for="search">Buscar: </label><input id="search"  placeholder="Busqueda" name="busqueda" type="search" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>

  </form>



  <div class="loginF">
    <!--a class="boton" href="" id="butt">Entrar</a-->
    <form action="indexConectado.php" method="POST" class="">
      <label for="user">Usuario: </label><input  id="user" name="user" type="text" placeholder="Usuario" required/>
      <label for="pass">Contraseña: </label><input id="pass"  name="password" type="password" placeholder="Contraseña" required/>
      <button class="boton" type="submit">Entrar</button>
    </form>
    <a class="boton" href="registro.php">Registro</a>
  </div>
</header>
