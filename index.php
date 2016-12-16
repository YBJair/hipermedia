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

  if(isset($_GET["error"])){
    switch ($_GET["error"]){
      case 0:
        echo("Fichero vacío");
        break;
      default:
        echo("Error desconocido");
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
  if(($fichero = @file(CRITICA)) == false){
  echo("No se pudo abrir el fichero para la sección de selección de críticos");
} else if(count($fichero) > 0){
    if(isset($_COOKIE["random"])){
      do{
        $crit = mt_rand(1,count($fichero)-1);
      }while($crit == $_COOKIE["random"]);
      setcookie("random",$crit);
    } else{
      $crit = mt_rand(1,count($fichero)-1);
      setcookie("random",$crit);
    }
    $linea = $fichero[$crit];
    $info = explode("<>",$linea);

    $id = $info[0];
    $critico = $info[1];
    $coment = $info[2];
    $sentencia = "SELECT f.Titulo, f.Fichero, f.Fecha, f.Album, p.NomPais, a.Titulo as TituloAlbum, u.NomUsuario, u.Foto 
          FROM fotos f, paises p , albumes a, usuarios u
          WHERE f.Pais=p.idPais and f.idFoto = $id and a.idAlbum = f.Album and u.idUsuario = a.Usuario";
    $resultado= mysqli_query($bbdd, $sentencia);
    if ($resultado!=false && $resultado->num_rows> 0){
        $fila = $resultado->fetch_assoc();
        $foto= $fila ["Fichero"];
        $titulo= $fila ["Titulo"];
        $fecha= $fila ["Fecha"];
        $nombrepais= $fila["NomPais"];
        $nomUsu = $fila["NomUsuario"];
        $titAlbum = $fila["TituloAlbum"];
        $idAlbum = $fila["Album"];
        $fotoUsu = $fila["Foto"];

        if($nombrepais==null){
      $nombrepais="Desconocido";
    }

    if($idAlbum==null){
      $titAlbum="No tiene album";
    }
    
        
    }
  

?>
<h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
<?php
echo <<<HEREDOC
<main>
  <h2 id="titulo">$titulo</h2>
  <h3 id="fecha">Fecha: $fecha</h3>
  <p id="detalleImg">
      <a href='imagen.php?id=$id' ><img  width="70%"  src='$foto' alt='$titulo'/></a>
  </p> 
  <div class="propietarioImagen"><h3>Subido por: </h3> <p><img src="images/$fotoUsu" alt="foto de perfil"/><span>$nomUsu</span></p></div>
  <h3>Detalles</h3>

  <ul>
    <li><b>Pais:</b> $nombrepais</li>
    <li><b>Album:</b> <a href="album.php?id=$idAlbum">$titAlbum</a></li>
    <li><b>Crítico: </b> $critico</li>
    <li><b>Comentario: </b> $coment</li>
  </ul>
</main>
HEREDOC;
} else {
  header("location: index.php?error=0");
}

?>
<main>
<?php
  $sentencia= "SELECT idFoto, Fichero, Titulo, Fecha, Pais, NomPais FROM fotos, paises WHERE idPais=Pais ORDER BY FRegistro DESC LIMIT 5";
  $resultado= mysqli_query($bbdd, $sentencia);


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
