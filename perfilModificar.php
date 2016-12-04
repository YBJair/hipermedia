<?php
  $title= "Perfil";
  include("includes/head.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
      exit;
  }
  include("includes/headerC.php");
  $id = (String)$_SESSION['remember'];

  if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Las contraseñas no coinciden";
    break;
    case 1:
    echo "La contraseña no es correcta";
    break;
    case 3:
    echo "El email tiene un forma inválido";
    break;
    case 4:
    echo "El nombre de usuario solo puede tener valores numéricos o letras del alfabeto inglés";
    break;
    case 5:
    echo "La contraseña solo puede tener carácteres del alfabeto inglés, números y barra baja _";
    break;
    case 6:
    echo "La contraseña debe tener por lo menos una mayúscula, una minúscula y un número";
    break;
    case 7:
    echo "La contraseña debe tener entre 6 y 15 carácteres";
    break;
    case 8:
    echo "El nombre de usuario debe tener entre 3 y 15 carácteres";
    break;
    default:
    echo "Error desconocido";
    break;
  }
  echo "</h3>";
  }
  
  $sentencia = "select NomUsuario, Email, Sexo, FNacimiento, Ciudad, Foto, Pais
      from Usuarios u where $id = idUsuario";
  $resultado = mysqli_query($bbdd, $sentencia);
  $fila = $resultado->fetch_assoc();
?>

<p class="registro"> La contraseña debe tener entre 6 y 15 carácteres, mínimo una mayúscula, una minúscula y un número </p>
<p class="registro"> El nombre de usuario debe tener entre 3 y 15 carácteres, solo se permiten números y alfabeto inglés</p>
<main>


<h1>Modificar datos</h1>

<form action= "perfilModificarConfirmacion.php" method="POST">
  <p>
    <p>
      <label for="userName">Usuario: </label><input id="userName" name="nombre" type="text" required 
      <?php if (isset($fila['NomUsuario'])) echo "value='".$fila['NomUsuario']."'"; ?>/>

    </p>
    <p>
      <label for="newPassword">Nueva contraseña: </label><input id="newPassword" name="newPass" type="password" required/>
      <label for="confirm">Confirmar contraseña: </label><input id="confirm" name="conPass" type="password" required/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email" type="email" required 
      <?php if (isset($fila['Email'])) echo "value='".$fila['Email']."'"; ?>/>

    </p>
    <p>
      <label for="gender">Genero: </label>
      <select id="gender" name="sexo">
        <option value="1" > Hombre</option>
        <option value="2" 
        <?php if (isset($fila['Sexo'])&&$fila['Sexo']=="2") echo "selected"; ?>> Mujer</option>

      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth" type="date" name="fecha" required 
      <?php if (isset($fila['FNacimiento'])) echo "value='".$fila['FNacimiento']."'"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" type="text" name="ciudad" placeholder="Ciudad" 
      <?php if (isset($fila['Ciudad'])) echo "value='".$fila['Ciudad']."'"; ?>/>

      <label for="country">Pais: </label>
      <select id="country" name="pais" >

        <?php include("includes/paises.php"); ?>


      </select>
      Asegurese de elegir bien su país

  </p>
  <p>
      <label for="password">Contraseña actual: </label><input id="password" name="pass" type="password" required/>
  </p>
  <p>
      <button type="submit" name="button">Guardar cambios</button>
      
  </p>
</form>
<form action="menuperfil.php">
        <button type="submit" name="button">Volver</button>
      </form>
</main>

<?php include("includes/footer.php");?>