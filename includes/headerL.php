<header>
  <a href="index.php" id="logo"><img src="images/logo.jpg" alt="logo" /></a>

  <form action="buscar.php" method="GET" class="search text">

    <label for="search">Buscar: </label><input id="search"  placeholder="Busqueda" name="busqueda" type="search" class=""/>
    <button type="submit"> <i class="material-icons">search</i></button>

  </form>

  <?php
  //Comprobacion existe envio post
  if(isset($_POST)){
    if(isset($_POST["user"]) && isset($_POST["password"])){
      //Comprobamos los parametros (en un futuro se comprobaran con la base de datos)
      $user=$_POST["user"];
      $pass=$_POST["password"];


      $comprobacion = "SELECT NomUsuario, idUsuario FROM usuarios u WHERE u.NomUsuario = '".$user."' and u.Clave ='".$pass."'";
      $result = mysqli_query($bbdd,$comprobacion); //Comprobamos que la password y usuario haya sido correctamente introducida.
      //Devuelve el Nombre del usuario cuyo alias y contraseña coincida

      if($result!=false && !mysqli_error($bbdd)){
        $row = $result->fetch_assoc();


        if($row['NomUsuario'] != ""){
          if(isset($_POST["remember"]) && ($_POST["remember"]=="Yes")){
            setcookie("remember_user", $user);
            setcookie("remember_pass", $pass);
            setcookie("remember_time", time());
          }
          $_SESSION["remember"]=(int)$row['idUsuario'];

          header("location: menuperfil.php");
        }
        else {
          header("location: index.php?error");
        }
      }

    }
  }

  if(isset($_GET['borrarcookie'])){
    if(isset($_COOKIE['remember_user'])){
      setcookie("remember_user", "", time() -3600);
      setcookie("remember_pass", "", time() -3600);
      setcookie("remember_time", "", time() -3600);
    }
  }
  ?>

  <div class="loginF">
    <!--a class="boton" href="" id="butt">Entrar</a-->

    <form action="index.php" method="POST" class="text">
      <?php
      if(isset($_COOKIE['remember_user'])){
        $dia = date("d/m/Y", $_COOKIE['remember_time']);
        $hora = date("h:i", $_COOKIE['remember_time']);

        echo <<<HEREDOC

        <div>Hola {$_COOKIE['remember_user']}, su ultima visita fue el $dia a las $hora</div>
        <button class='boton' type='submit'>Entrar</button>
        <a class='boton' href='index.php?borrarcookies'>Registro</a>

HEREDOC;

      } else{
        ?>

        <label for="user">Usuario: </label><input  id="user" name="user" type="text" placeholder="Usuario" required/>
        <label for="pass">Contraseña: </label><input id="pass"  name="password" type="password" placeholder="Contraseña" required/>
        <div class="absol">
          <input id="remember"type="checkbox" name="remember"><label class="show" for="remember">¿Recordarme?</label>
        </div>
        <button class="boton" type="submit">Entrar</button>

        <?php }?>
      </form>

      <a class="boton" href="registro.php">Registro</a>
    </div>
  </header>
