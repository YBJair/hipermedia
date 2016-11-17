<?php
$title= "Registro";
include("includes/head.php");
include("includes/headerL.php");

if(isset($_POST)){
  //se comprueba que esten inicializacdas
  if(isset($_POST["nombre"]) && isset($_POST["pass"]) && isset($_POST["pass2"]) && isset($_POST["email"]) && isset($_POST["sexo"])
  && isset($_POST["fecha"]) && isset($_POST["ciudad"]) && isset($_POST["pais"]) && isset($_POST["foto"])){
    //Comprobamos con los introducidos
    if($_POST["nombre"] != "" && $_POST["nombre"] != "jesus" && $_POST["nombre"] != "jair" && $_POST["nombre"] != "test"){
      if ($_POST["pass"] == $_POST["pass2"]){
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
          $user   = $_POST["nombre"];
          $pass   = $_POST["pass"];
          $email  = $_POST["email"];
          $sexo   = $_POST["sexo"];
          $fecha  = $_POST["fecha"];
          $ciudad = $_POST["ciudad"];
          $pais   = $_POST["pais"];
          $foto   = $_POST["foto"];

          echo "<p class = \"registro\">El usuario se ha registrado correctamente</p>\n";
          echo "<p class = \"registro\">Usuario: $user</p>\n";
          echo "<p class = \"registro\">Email: $email</p>\n";
          echo "<p class = \"registro\">Sexo: $sexo</p>\n";
          echo "<p class = \"registro\">Fecha: $fecha</p>\n";
          echo "<p class = \"registro\">Ciudad: $ciudad </p>\n";
          echo "<p class = \"registro\">País: $pais </p>\n";

        } else header("location: registro.php?error=3");
      } else header("location: registro.php?error=2");
    } else header("location: registro.php?error=1");
  }
}
?>

<h1 class="index">Registro nuevo usuario</h1>

<?php
if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Debe enviar todos los datos";
    break;
    case 1:
    echo "El usuario ya esta registrado";
    break;
    case 2:
    echo "Las contraseñas no coinciden";
    break;
    case 3:
    echo "El email no es valido";
    break;
    default:
    echo "error desconocido";
    break;
  }
  echo "</h3>";
}
?>

<main>
  <form action="registro.php" method="POST">
    <p>
      <label for="userName">Usuario: </label><input id="userName" name="nombre" type="text" required <?php if (isset($user)) echo "value='".$user."' disabled"; ?>/>
    </p>
    <p>
      <label for="password">Contraseña: </label><input id="password" name="pass" type="password" required/>
      <label for="confirm">Confirmar contraseña: </label><input id="confirm" name="pass2" type="password" required/>
    </p>
    <p>
      <label for="email">Email: </label><input id="email" name="email" type="email" placeholder="example@gmail.com" required <?php if (isset($email)) echo "value='".$email."' disabled"; ?>/>
    </p>
    <p>
      <label for="gender">Genero: </label>
      <select id="gender" name="sexo" <?php if (isset($sexo)) echo "disabled"; ?>>
        <option value="male" > Hombre</option>
        <option value="female" <?php if (isset($sexo)&&$sexo=="female") echo "selected"; ?>> Mujer</option>
      </select>
    </p>
    <p>
      <label for="birth" >Fecha de nacimiento: </label><input id="birth" type="date" name="fecha" required <?php if (isset($fecha)) echo "value='".$fecha."' disabled"; ?>>
    </p>
    <p>
      <label for="city">Ciudad: </label>
      <input id="city" type="text" name="ciudad" placeholder="Ciudad" <?php if (isset($ciudad)) echo "value='".$ciudad."' disabled"; ?>/>
      <label for="country">Pais: </label>
      <select id="country" name="pais" <?php if (isset($pais)) echo "disabled"; ?>>

        <?php include("includes/paises.php"); ?>

        
      </select>
    </p>

    <p>
      <label for="profile">Imagen de perfil: </label><input id="profile" name="foto" type="file" />
    </p>
    <button type="submit" name="button">Aceptar</button>
  </form>
</main>

<?php include("includes/footer.php");?>
