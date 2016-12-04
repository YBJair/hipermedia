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
      <label for="userName">Usuario: </label><input id="userName" name="nombre" disabled type="text" required 
      <?php echo "value='".$user."'"; ?>/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email" disabled type="email" required 
      <?php  echo "value='".$email."'"; ?>/>
    </p>
    <p>
      <label for="gender" >Genero: </label>
      <select id="gender" disabled name="sexo">
        <option value="1" > Hombre</option>
        <option value="2" 
        <?php if($sexo=="2") echo "selected"; ?>> Mujer</option>
      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth"  disabled type="date" name="fecha" required 
      <?php  echo "value='".$fecha."'"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" disabled type="text" name="ciudad" placeholder="Ciudad" 
      <?php echo "value='".$ciudad."'"; ?>/>
      <label for="country">Pais: </label>
      <select id="country" disabled name="pais" >

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
