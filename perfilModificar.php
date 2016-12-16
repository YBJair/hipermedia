<?php
$title= "Perfil";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}
include("includes/headerC.php");
$id = (String)$_SESSION['remember'];

if(isset($_POST["nombre"]) && isset($_POST["pass"]) && isset($_POST["pass2"]) && isset($_POST["email"]) && isset($_POST["sexo"])
&& isset($_POST["fecha"]) && isset($_POST["ciudad"]) && isset($_POST["pais"])){
  //Comprobamos con los introducidos
  if($_POST["nombre"] != ""){
    if ($_POST["pass"] == $_POST["pass2"]){
      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $user   = $_POST["nombre"];
        $pass   = $_POST["pass"];
        $email  = $_POST["email"];
        $sexo   = $_POST["sexo"];
        $fecha  = $_POST["fecha"];
        $ciudad = $_POST["ciudad"];
        $pais   = $_POST["pais"];

        $fRegistro= date("Y-m-d H:i:s");

        include("includes/filtros.php");

        if(!preg_match($filtroEmail, $email)){
          header("location: registro.php?error=3");
          exit;
        }
        if(preg_match($filtroUser, $user)){
          header("location: registro.php?error=4");
          exit;
        }
        if(preg_match($filtroPass1,$pass)){
          header("location: registro.php?error=5");
          exit;
        }
        if(!preg_match($filtroPassMayu,$pass) || !preg_match($filtroPassMinu,$pass) || !preg_match($filtroPassNum,$pass)){
          header("location: registro.php?error=6");
          exit;
        }
        if(strlen($pass) > 15 || strlen($pass) < 6 ){
          header("location: registro.php?error=7");
          exit;
        }
        if(strlen($user) > 15 || strlen($user) < 3){
          header("location: registro.php?error=8");
          exit;
        }
        /* if(!preg_match($filtroFecha,$fecha))
        header("location: registro.php?error=9");
        if(preg_match($filtroFechaMes,$fecha))

        header("location: registro.php?error=9");
        if(preg_match($filtroFechaMes2,$fecha))
        header("location: registro.php?error=9");
        if(preg_match($filtroFechaFebrero,$fecha))
        header("location: registro.php?error=9");*/

        $trozos = explode("-",$fecha);
        $fecha = $trozos[0]."-".$trozos[1]."-".$trozos[2];

        include_once("includes/funciones.php");

        if(!isset($_FILES["foto"]))
        {
          $registro = "UPDATE usuarios SET NomUsuario='$user', Clave='$pass', Email='$email',Sexo=$sexo,
          FNacimiento='$fecha',Ciudad='$ciudad', Pais=$pais WHERE idUsuario=$idUsu";
          $resultado= mysqli_query($bbdd, $registro);
        }

        else
        {
          if($_FILES["foto"]["error"]){
            header("location: registro.php?error=10");
            exit;
          }
          else{
            include_once("includes/funciones.php");
            $foto = sanear_string($user)."_".time()."_".sanear_string($_FILES["foto"]["name"]);
            if(@move_uploaded_file($_FILES["foto"]["tmp_name"], "images/$foto")){
              


              $registro = "UPDATE usuarios SET NomUsuario='$user', Clave='$pass', Email='$email',Sexo=$sexo,
              FNacimiento='$fecha',Ciudad='$ciudad', Foto=$foto, Pais=$pais WHERE idUsuario=$idUsu";
              $resultado= mysqli_query($bbdd, $registro);
            }
          }
        }

        if($sexo == 1) //Los cambiamos para que al imprimirlos sea legible para el usuario
        $sexo = "Hombre";
        else
        $sexo = "Mujer";

        /*$contenido = <<<REG
  <div class="resultadoRegistro">
  <h3>El usuario se ha registrado correctamente</h3>
  <pre>
  Usuario: $user
  Email: $email
  Sexo: $sexo
  Fecha: $fecha
  Ciudad: $ciudad
  País: $pais
  </pre>
  </div>
  REG;
        echo $contenido;*/

      } else header("location: registro.php?error=3");
    } else header("location: registro.php?error=2");
  } else header("location: registro.php?error=1");
} //else echo"me cago en dios";
//else{echo "tusmuertos";}


include_once("includes/errores.php");
?>

<p class="registro"> La contraseña debe tener entre 6 y 15 carácteres, mínimo una mayúscula, una minúscula y un número </p>
<p class="registro"> El nombre de usuario debe tener entre 3 y 15 carácteres, solo se permiten números y alfabeto inglés</p>
<main>


  <h1>Modificar datos</h1>

  <form action= "perfilModificarConfirmacion.php" method="POST" enctype="multipart/form-data">
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
        <?php if (isset($user)) echo "value='".$user."'"; ?>/>

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
        <label for="photo">Foto de perfil:</label><input id="photo" type="file" name="foto" value="<?php echo $foto;?>">
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
