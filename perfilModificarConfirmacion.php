<?php
  $title= "Perfil";
  include("includes/head.php");
  include("includes/headerL.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
	}
  $id = (String)$_SESSION['remember'];
  $sentencia = "select NomUsuario, Email, Sexo, FNacimiento, Ciudad, Foto, Pais
      from Usuarios u where $id = idUsuario";
      echo($sentencia);
  $resultado = mysqli_query($bbdd, $sentencia);
  $fila = $resultado->fetch_assoc();
?>
<main>
  

<p>"¿Está seguro de querer guardar los cambios?"</p>
<form action = "menuperfil.php" method = "POST"> 
    
    <p>
      <label for="userName">Usuario: </label><input id="userName" name="nombre" disabled type="text" required <?php if (isset($fila['NomUsuario'])) echo "value='".$fila['NomUsuario']."'"; ?>/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email" disabled type="email" required <?php if (isset($fila['Email'])) echo "value='".$fila['Email']."'"; ?>/>
    </p>
    <p>
      <label for="gender" >Genero: </label>
      <select id="gender" disabled name="sexo">
        <option value="1" > Hombre</option>
        <option value="2" <?php if (isset($fila['Sexo'])&&$fila['Sexo']=="2") echo "selected"; ?>> Mujer</option>
      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth"  disabled type="date" name="fecha" required <?php if (isset($fila['FNacimiento'])) echo "value='".$fila['FNacimiento']."'"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" disabled type="text" name="ciudad" placeholder="Ciudad" <?php if (isset($fila['Ciudad'])) echo "value='".$fila['Ciudad']."'"; ?>/>
      <label for="country">Pais: </label>
      <select id="country" disabled name="pais" >

        <?php include("includes/paises.php"); ?>

        
      </select>
      
  </p>
 <p>
        <button type="submit" name = "button">Guardar cambios</button>
 </p>
       <p> <button type="button" action="menuperfil.php">Cancelar</button></p>
</form>



</main>

<?php include("includes/footer.php");?>