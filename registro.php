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
          $fRegistro = getdate();
          $fRegistro = $fRegistro['year']."-".$fRegistro['month']."-".$fRegistro['mday']." ".$fRegistro['hours'].":".$fRegistro['minutes'].":".$fRegistro['seconds'];


          $filtroUser = "/[^[:alnum:]]/"; //Alfabeto ingles y numeros (negativo)
          $filtroPass1 = "/[^[:alnum:]_]/"; //Alfabeto ingles, numeros y barra baja (negativo)
          $filtroPassMayu = "/[[:upper:]+]/"; //Obligatorio una mayuscula 
          $filtroPassMinu = "/[[:lower:]+]/"; //Obligatorio una minuscula
          $filtroPassNum = "/[0-9+]/"; //Obligatorio un numero
          $filtroEmail = "/.+@.+\..{2,4}$/"; //Patron tipico de email (ddd@ff.ff) maximo 4 en el dominio global y minimo 2
          $filtroFecha = "/[0-3][0-9]-[01][0-9]-[0-9]{4}/"; //Comprueba que la fecha tenga un formato adecuado
          $filtroFechaMes = "/^.{3}1[3-9]/"; //Comprueba que el mes no este entre 13 y 19
          $filtroFechaMes2 = "/^.{3}00/"; //Comprueba que el mes no sea 00
          $filtroFechaFebrero = "/^3[01]-02/"; //Comprueba que febrero sea especialito como siempre

          if(!preg_match($filtroEmail, $email))
              header("location: registro.php?error=3");
          if(preg_match($filtroUser, $user))
              header("location: registro.php?error=4");
          if(preg_match($filtroPass1,$pass))
              header("location: registro.php?error=5");
          if(!preg_match($filtroPassMayu,$pass) && !preg_match($filtroPassMinu,$pass) && !preg_match($filtroPassNum,$pass) )
              header("location: registro.php?error=6");
          if(strlen($pass) > 15 || strlen($pass) < 6 )
              header("location: registro.php?error=7");
          if(strlen($user) > 15 || strlen($user) < 3)
              header("location: registro.php?error=8");
         /* if(!preg_match($filtroFecha,$fecha))
             // header("location: registro.php?error=9");
          if(preg_match($filtroFechaMes,$fecha))

              header("location: registro.php?error=9");
          if(preg_match($filtroFechaMes2,$fecha))
              header("location: registro.php?error=9");
          if(preg_match($filtroFechaFebrero,$fecha))
              header("location: registro.php?error=9");*/


          if($sexo == "male")
            $sexo = 1;
          else
            $sexo = 2;

          $trozos = explode("-",$fecha);
          $fecha = $trozos[2]."-".$trozos[1]."-".$trozos[0];

          $registro = "insert into 'usuarios' ('NomUsuario', 'Clave', 'Email', 'Sexo', 'FNacimiento', 'Ciudad', 'Foto', 'FRegistro', 'Pais')
           values($user,$pass,$email,$sexo,$fecha,$ciudad,$foto,$fRegistro,$pais)";

          $resultado= mysqli_query($bbdd, $registro);

          if($sexo == 1)
            $sexo = "Hombre";
          else
            $sexo = "Mujer";

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
    case 4:
    echo "<p>Carácter/es inválido/s en el nombre de usuario (letras y números)</p>";
    break;
    case 5:
    echo "<p>Carácter/es inválido/s en la contraseña (letras, números y _)</p>";
    break;
    case 6:
    echo "<p>Es necesario como mínimo una mayúscula, una miníscula y un número en la contraseña</p>";
    break;
    case 7:
    echo "<p>Tamaño de contraseña incorrecto, debe tener entre 6 y 15 carácteres</p>";
    break;
    case 8:
    echo "<p>Tamaño de nombre de usuario incorrecto, debe tener entre 3 y 15 carácteres</p>";
    break;
    case 9:
    echo "<p> Fecha no válida</p>";
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
