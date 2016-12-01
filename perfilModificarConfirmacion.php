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
    else
        $user   = $_POST["nombre"];
        $pass   = $_POST["pass"];
        $email  = $_POST["email"];
        $sexo   = $_POST["sexo"];
        $fecha  = $_POST["fecha"];
        $ciudad = $_POST["ciudad"];
        $pais   = $_POST["pais"];
?>
<main>


<p>¿Está seguro de querer guardar los cambios?</p>
<form action = "menuperfil.php" method = "POST">

    <p>
      <label for="userName">Usuario: </label><input id="userName" name="nombre" disabled type="text" required <?php echo "value='".$user."'"; ?>/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email" disabled type="email" required <?php if (isset($fila['Email'])) echo "value='".$email."'"; ?>/>
    </p>
    <p>
      <label for="gender" >Genero: </label>
      <select id="gender" disabled name="sexo">
        <option value="1" > Hombre</option>
        <option value="2" <?php if($sexo=="2") echo "selected"; ?>> Mujer</option>
      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth"  disabled type="date" name="fecha" required <?php  echo "value='".$fecha."'"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" disabled type="text" name="ciudad" placeholder="Ciudad" <?php echo "value='".$ciudad."'"; ?>/>
      <label for="country">Pais: </label>
      <select id="country" disabled name="pais" >

        <?php include("includes/paises.php"); ?>


      </select>

  </p>
 <p>
        <button type="submit" name = "button">Guardar cambios</button>
 </p>
        <form action="menuperfil.php">
            <button type="submit" name = "button">Cancelar</button>
        </form>

</form>



</main>

<?php include("includes/footer.php");?>
