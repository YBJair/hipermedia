<?php
  $title= "Solicitar Album";
  include("includes/head.php");
  include("includes/headerC.php");

  define("IMG_PER_PAGE", 10);

  if(isset($_SESSION["remember"])==false){
    header("location: index.php");
    exit;
    }
  if(isset($_GET["page"])){
      $page = $_GET["page"];
  }else{
      $page = 1;
  }
  if(!isset($_GET["id"])){
      header("location: index.php");
  } else {
      $idAlbum = $_GET["id"];
      $sentencia = "SELECT a.Titulo, f.Titulo as fTitulo, f.Fichero, f.idFoto
                from albumes a, fotos f
                where a.idAlbum = $idAlbum and f.Album = $idAlbum";
      $resultado = mysqli_query($bbdd, $sentencia);
      $purga = ($page-1) * IMG_PER_PAGE;

      if ($resultado!=false && $resultado->num_rows> 0){
          $total = ceil(($resultado->num_rows) / IMG_PER_PAGE);
          $contenido = "";
          for($i = 0; $i < $purga; $i++){
             $datos = $resultado->fetch_assoc();
          }
          for($i = 0; $i < IMG_PER_PAGE ; $i++){
            if($datos = $resultado->fetch_assoc()){
                $titulo = $datos["Titulo"];
                $fTitulo = $datos["fTitulo"];
                $foto = $datos["Fichero"];
                $idF = $datos["idFoto"];
                $fichero = $datos["Fichero"];
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
                    
                ob_end_clean();    
                imagedestroy($src_img);
                imagedestroy($marco);
                $contenido = $contenido . $aux;
            }
          
          
                
          }
          $head = <<<HTML
            <main>
                <h1>$titulo</h1>
HTML;
         $back = "\n</main>\n";
         $contenido = $head . $contenido;
         echo ("$contenido");
         if($total > 1){
             echo("Página ");
            for($i = 1; $i <= $total; $i++){
                echo("<a href=verAlbum.php?id=$idAlbum&page=$i>$i</a>\n");
            }
        }
        echo($back);
      }else  echo "<h1> Error 404: Álbum no encontrado</h1>\n";
         
      

  
      
  }

  ?>

  <?php include("includes/footer.php");?>