<?php

?>

<header class="text">
  <a href="index.php" id="logo"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscar.php" method="GET" class="search">

    <label for="search">Buscar: </label><input id="search"  placeholder="Busqueda" name="busqueda" type="search" autofocus/>
    <button type="submit"> <i class="material-icons">search</i></button>

  </form>

  <?php
  //Comprobacion existe envio post
    if(isset($_POST)){
      if(isset($_POST["user"]) && isset($_POST["password"])){
        //Comprobamos los parametros (en un futuro se comprobaran con la base de datos)
        $user=$_POST["user"];
        $pass=$_POST["password"];
        if(($user=="jesus" && $pass=="admin") || ($user=="jair" && $pass=="admin") || ($user=="test" && $pass=="admin")){
          header("location: principal.php");
        }else{
          header("location: index.php?error");
        }
      }
    }
  ?>

  <div class="loginF">
    <!--a class="boton" href="" id="butt">Entrar</a-->
    <form action="index.php" method="POST" class="">
      <label for="user">Usuario: </label><input  id="user" name="user" type="text" placeholder="Usuario" required/>
      <label for="pass">Contraseña: </label><input id="pass"  name="password" type="password" placeholder="Contraseña" required/>
      <button class="boton" type="submit">Entrar</button>
    </form>
    <a class="boton" href="registro.php">Registro</a>
  </div>
</header>
