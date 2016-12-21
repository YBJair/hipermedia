<?php
  $title= "Solicitar Album";
  include("includes/head.php");
  include("includes/headerC.php");

  if(isset($_SESSION["remember"])==false){
    header("location: index.php");
    exit;
    }

  if(!isset($_GET["id"])){
      header("location: index.php");
  } else {
      $id = $_GET["id"];
    
      $sentencia = "SELECT NomUsuario, Email, Sexo, FNacimiento, Ciudad, Foto, p.NomPais
            from usuarios u, paises p
            where u.idUsuario = $id and p.idPais = u.Pais";
      $datos = mysqli_query($bbdd, $sentencia);

      $sentencia = "SELECT Titulo, idAlbum
                from albumes a
                where a.Usuario = $id";
      $albumes = mysqli_query($bbdd, $sentencia);

      if ($datos!=false && $datos->num_rows> 0){
          $datos=$datos->fetch_assoc();
          $nombre = $datos["NomUsuario"];
          $email = $datos["Email"];
          $sexo = $datos["Sexo"];
          $fnac = $datos["FNacimiento"];
          $ciudad = $datos["Ciudad"];
          $foto = $datos["Foto"];
          $pais = $datos["NomPais"];

          if($sexo == 1) $sexo = "Hombre";
          else $sexo = "Mujer";
          
                
          $contenido = <<<HTML
            <main>
                <h1>$nombre</h1>
                <img src = "images/$foto" alt = "Foto perfil" />
                <pre>
                    Email: $email
                    Sexo: $sexo
                    Fecha de Nacimiento: $fnac
                    Ciudad: $ciudad
                    País: $pais
                </pre>
HTML;

        if($albumes != false && $albumes->num_rows>0){    
            $contenido = $contenido. "\n<h2>Álbumes</h2> \n"  ;                  
              while($album = $albumes->fetch_assoc()){
                  $titulo = $album["Titulo"];
                  $id = $album["idAlbum"];
                  $string = <<<HTML
                    <p><a href = "verAlbum.php?id=$id">$titulo</a></p>
HTML;
                  $contenido = $contenido . $string;
              }
          }
          $contenido = $contenido . "</main>";
          echo ($contenido);
      } else {
          echo "<h1> Error 404: Usuario no encontrada</h1>\n";
      }  
  }

  



include("includes/footer.php");?>