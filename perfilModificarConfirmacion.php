<?php
  $title= "Perfil";
  include("includes/head.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
      exit;
  }
  include("includes/headerC.php");
    if(isset($_POST["nombre"]) == false)
        header("location: index.php");
    else{
        $user   = $_POST["nombre"];
        $pass   = $_POST["pass"];
        $nPass = $_POST["newPass"];
        $cPass = $_POST["conPass"];
        $email  = $_POST["email"];
        $sexo   = $_POST["sexo"];
        $fecha  = $_POST["fecha"];
        $ciudad = $_POST["ciudad"];
        $pais   = $_POST["pais"];
        include("includes/filtros.php");

        if($nPass == "" && $cPass == ""){
          $nPass = $pass;
          $cPass = $pass;
        }

        if(!preg_match($filtroEmail, $email))
              header("location: perfilModificar.php?error=3");
          if(preg_match($filtroUser, $user))
              header("location: perfilModificar.php?error=4");
          if(preg_match($filtroPass1,$nPass))
              header("location: perfilModificar.php?error=5");
          if(!preg_match($filtroPassMayu,$nPass) || !preg_match($filtroPassMinu,$nPass) || !preg_match($filtroPassNum,$nPass) )
              header("location: perfilModificar.php?error=6");
          if(strlen($nPass) > 15 || strlen($nPass) < 6 )
              header("location: perfilModificar.php?error=7");
          if(strlen($user) > 15 || strlen($user) < 3)
              header("location: perfilModificar.php?error=8");
    }
    if($nPass == $cPass){
      $id = (String)$_SESSION['remember'];
      $comprobacion = "SELECT NomUsuario FROM usuarios u WHERE u.idUsuario = ".$id." and u.Clave ='".$pass."'";
      $result = mysqli_query($bbdd,$comprobacion); //Comprobamos que la password e id de usuario haya sido correctamente introducida.
      //Devuelve el Nombre del usuario cuyo id y contraseña coincida
      
      if($result!=false && !mysqli_error($bbdd)){
          $row = $result->fetch_assoc();
          if($row['NomUsuario'] == ""){
            header("location: perfilModificar.php?error=1");
          }
      } else header("location: perfilModificar.php?error=6");

    }else header("location: perfilModificar.php?error=0");

?>
<main>


<p>¿Está seguro de querer guardar los cambios?</p>
<form action="menuperfil.php" method="POST">

    <p>
      <label for="userName">Usuario: </label><input id="userName" name="nombre"  type="text" required 
      <?php echo "value='".$user."'"; ?>/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email"  type="email" required 
      <?php  echo "value='".$email."'"; ?>/>
    </p>
    <p>
      <label for="pass">Password: </label><input type="password" name="pass" required id="password"
      <?php  echo "value='".$pass."'"; ?>/>

    </p>
    <p>
      <label for="gender" >Genero: </label>
      <select id="gender"  name="sexo">
        <option value="1" > Hombre</option>
        <option value="2" 
        <?php if($sexo=="2") echo "selected"; ?>> Mujer</option>
      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth"   type="date" name="fecha" required 
      <?php  echo "value='".$fecha."'"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" type="text" name="ciudad" placeholder="Ciudad" 
      <?php echo "value='".$ciudad."'"; ?>/>
      <label for="country">Pais: </label>
      <select id="country"  name="pais" >

        <?php include("includes/paises.php"); ?>


      </select>

    </p>
    <p>
  
       <button type="submit" name = "button">Guardar cambios</button>
    </p>
        

</form>

      <form action="menuperfil.php">
            <button type="submit" name = "button">Cancelar</button>
        </form> 

</main>

<?php include("includes/footer.php");?>
