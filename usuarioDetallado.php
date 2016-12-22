<?php
  $title= "Usuario Detallado";
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

      /*$sentencia = "SELECT  a.Titulo, idAlbum, Fichero
                from albumes a, fotos f
                where a.Usuario = $id and a.idAlbum = f.Album";*/
      $sentencia = "SELECT idAlbum, Titulo, Descripcion
                FROM albumes a
                WHERE a.Usuario = $id";
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
            $titulo = "";                
              while($album = $albumes->fetch_assoc()){
                  if($titulo != $album["Titulo"]){
                  $titulo = $album["Titulo"];
                  $id = $album["idAlbum"];

                  $sentencia = "SELECT Fichero
              FROM fotos f, albumes a
              WHERE f.Album = $id limit 1";
             $fotos = mysqli_query($bbdd, $sentencia);
            
             if($fotos != false && !mysqli_error($bbdd)){
                if($fotoA = $fotos->fetch_assoc())
                     $foto = $fotoA["Fichero"]; 
                else $foto = "images/perfil.jpg";
            }

                  
//MINIATURIZACION
                  ob_start();
                $img = getimagesize($foto);

                if($img['mime']=='image/png'){ $src_img = imagecreatefrompng($foto); }
                if($img['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime'] == 'image/gif'){$src_img = imagecreatefromgif($foto);}

                $o_x = imageSX($src_img);
                $o_y = imageSY($src_img);

                $marco = imagecreatetruecolor(100,100);
                
                imagecopyresampled($marco, $src_img, 0, 0, 0, 0, 100, 100, $o_x, $o_y);
                imagejpeg($marco);
                $img_src = "data:image/png;base64," . base64_encode(ob_get_contents());
                           
                $aux = "
                    <a href = imagen.php?id=$idF ><h3>$fTitulo</h3></a>
                    <p><a href = imagen.php?id=$idF ><img src= $img_src alt=$fTitulo /></a></p> ";
                    
                

//SAGGGGGGGGGGGGGGGG


                  $string = <<<HTML
                    <p><a href = "verAlbum.php?id=$id"><img src = $img_src alt = $title/></a><a href = "verAlbum.php?id=$id">$titulo</a></p>
HTML;
                  ob_end_clean();    
                  imagedestroy($src_img);
                  imagedestroy($marco);  
                  $contenido = $contenido . $string;
              }
          }
          $contenido = $contenido . "</main>";
          echo ($contenido);
        }
      } else {
          echo "<h1> Error 404: Usuario no encontrada</h1>\n";
      }  
  }

  



include("includes/footer.php");?>