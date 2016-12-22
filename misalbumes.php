<?php
$title= "Mis Albumes";
include("includes/head.php");

if(isset($_SESSION["remember"])==false){
  header("location: index.php");
  exit;
}

include("includes/headerC.php");

?>
<a class='boton' href='menuperfil.php'><i class="material-icons">arrow_back</i>Volver</a>
<main>
  <h1>Mis Albumes</h1>
  <ol>

  <?php
  $sentencia = "SELECT idAlbum, Titulo, Descripcion
                FROM albumes a
                WHERE a.Usuario = $idUsu";



  /*$sentencia = "SELECT idAlbum, a.Titulo, Descripcion, Fichero
                FROM albumes a, fotos f
                WHERE a.Usuario=$idUsu and f.Album = a.idAlbum";*/
  $resultado = mysqli_query($bbdd, $sentencia);

  if($resultado!=false && !mysqli_error($bbdd)){
    $idalbum = "";
    while($fila=$resultado->fetch_assoc()){
          //if($idalbum != $fila["idAlbum"]){
          $idalbum= $fila["idAlbum"];
          $tituloAlbum= $fila["Titulo"];
          
          $descripcionAlbum= "Descripción: ".$fila["Descripcion"];
          if($fila["Descripcion"]==null)
              $descripcionAlbum="No tiene descripción";

          $sentencia = "SELECT Fichero
              FROM fotos f, albumes a
              WHERE f.Album = $idalbum limit 1";
          $resultadoFoto = mysqli_query($bbdd, $sentencia);        
          if($resultadoFoto != false && !mysqli_error($bbdd)){
            if($filaFoto = $resultadoFoto->fetch_assoc())
              $foto = $filaFoto["Fichero"]; 
              else $foto = "images/perfil.jpg";
          }
             

           ob_start();
                $img = getimagesize($foto);

                if($img['mime']=='image/png'){ $src_img = imagecreatefrompng($foto); }
                if($img['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($foto); }
                if($img['mime'] == 'image/gif'){$src_img = imagecreatefromgif($foto);}

                $o_x = imageSX($src_img);
                $o_y = imageSY($src_img);

                $marco = imagecreatetruecolor(50,50);
                
                imagecopyresampled($marco, $src_img, 0, 0, 0, 0, 50, 50, $o_x, $o_y);
                imagejpeg($marco);
                $img_src = "data:image/png;base64," . base64_encode(ob_get_contents());

          $html = <<<HTML
    <li>
    <a href="album.php?id=$idalbum"> <img src = $img_src alt = $tituloAlbum/> </a><a href="album.php?id=$idalbum">$tituloAlbum</a>  
    <br/>
    <p>$descripcionAlbum</p>
    </li>
HTML;
          ob_end_clean();    
          imagedestroy($src_img);
          imagedestroy($marco);  
          echo $html;
        //}
      }
  }
  ?>
</ol>

  <hr/>

</main>

<?php include("includes/footer.php");?>
