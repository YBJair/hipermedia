<?php

?>

<header>
  <a href="index.php" id="logo"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscar.php" method="GET" class="search">

    <label for="search">Buscar: </label><input id="search" class="box"  placeholder="Busqueda" name="busqueda" type="search"/>
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
          if(isset($_POST["remember"]) && ($_POST["remember"]=="Yes" || $_POST["remember"]=="on")){
						setcookie("remember_user", $user);
						setcookie("remember_pass", $pass);
						setcookie("remember_time", time());
					}
					$_SESSION["remember"]=$user;

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
      <label for="user">Usuario: </label><input  id="user" class="box" name="user" type="text" placeholder="Usuario" required/>
      <label for="pass">Contraseña: </label><input id="pass" class="box"  name="password" type="password" placeholder="Contraseña" required/>
      <label class="show" for="remember">¿recordarme?</label><input id="remember"type="checkbox" name="remember" >
      <button class="boton" type="submit">Entrar</button>
    </form>
    <a class="boton" href="registro.php">Registro</a>
  </div>
</header>
