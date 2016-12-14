<?php
  $title= "Pictures and Images";
  include_once("includes/head.php");
  include_once("includes/headerL.php");
  if(isset($_GET["error"])){
    echo "<p style='text-align:right'>Introduce bien el usuario</p>";
  }
  //include_once("includes/bbddConexion.php");

  if(isset($_SESSION["remember"])==true){
		header("location: principal.php");
	}

	if(isset($_GET["q"]) && $_GET["q"]=="logout"){
    if(isset($_SESSION["remember"])){
       unset($_SESSION["remember"]);
       if(isset($_COOKIE["remember_user"])){
         setcookie("remember_user", "", time() -3600);
         setcookie("remember_pass", "", time() -3600);
         setcookie("remember_time", "", time() -3600);
       }
       header("location: index.php");
     }
	}

  if(isset($_POST["pass"]) && isset($_POST["borrar"])){

    if($_POST["borrar"] == "BORRAR"){
      $pass = $_POST["pass"];
      $id = (String)$_SESSION['remember'];
      $comprobacion = "SELECT NomUsuario FROM usuarios u WHERE u.idUsuario = ".$id." and u.Clave ='".$pass."'";
      $result = mysqli_query($bbdd,$comprobacion); //Comprobamos que la password haya sido correctamente introducida.
      //Devuelve el Nombre del usuario cuyo id y contraseña coincida

      if($result!=false && !mysqli_error($bbdd)){
          $row = $result->fetch_assoc();
          if($row['NomUsuario'] == ""){
            header("location: bajaUsuario.php?error=1");
          }else{ //Aqui borramos el usuario
            $borrar = "DELETE FROM usuarios WHERE idUsuario = $id";
            $borrando = mysqli_query($bbdd, $borrar);
          }
      } else header("location: bajaUsuario.php?error=6");
    }else header("location: bajaUsuario.php?error=0");
  }
  $sentencia= "SELECT idFoto, Fichero, Titulo, Fecha, Pais, NomPais FROM fotos, paises WHERE idPais=Pais ORDER BY FRegistro DESC LIMIT 5";
  $resultado= mysqli_query($bbdd, $sentencia);


?>
<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<main>
<?php

  if($resultado!=false && !mysqli_error($bbdd)){
    while($fila=$resultado->fetch_assoc()){
      $id= $fila ["idFoto"];
      $foto= $fila ["Fichero"];
      $titulo= $fila ["Titulo"];
      $fecha= $fila ["Fecha"];
      $pais= $fila ["Pais"];
      $nombrepais= $fila['NomPais'];

      //<!-- Resolucion: 250x167-->
      echo <<<HEREDOC2
  			<article>
          <a href='imagen.php?id=$id'><img src='$foto' alt='$titulo'/></a>
          <p>$titulo</p>
          <p>$fecha</p>
          <p>$nombrepais</p>
        </article>
HEREDOC2;

    }
  }

?>
</main>

<?php include_once("includes/footer.php");?>
