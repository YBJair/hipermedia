<?php
    
// Valores de la fecha.
    
  $fecha = date("Ymd");
  $fecha1 = (int) $fecha +1;
  $fecha2 = (int) $fecha1 -7;
  $sentencia = "SELECT FRegistro
                FROM fotos f
                WHERE FRegistro >= $fecha2 and FRegistro < $fecha1 ";
$filtro1 = " ";
$filtro2 = "-";

  $datos = mysqli_query($bbdd, $sentencia);
  if($datos != false && $datos->num_rows > 0){
      $values = array(0,0,0,0,0,0,0);
      $fecha = date("j");
      while($graf = $datos->fetch_assoc()){
        $eso = $graf["FRegistro"];
        $eso = explode($filtro1,$eso);
        $eso = explode($filtro2,$eso[0]);
        $dif = $fecha - (int) $eso[2];
        switch ($dif){
            case 0:
            $values[6]++;
            break;
            case 1:
            $values[5]++;
            break;
            case 2:
            $values[4]++;
            break;
            case 3:
            $values[3]++;
            break;
            case 4:
            $values[2]++;
            break;
            case 5:
            $values[1]++;
            break;
            case 6:
            $values[0]++;
            break;
            default:
            break;
        }
          
      }
        
  }
    
// Get the total number of columns we are going to plot

    
    $columns = count($values);

// Get the height and width of the final image

  
    $width = 450;
    $height = 300;
// Set the amount of space between each column

    
    $padding = 15;

// Get the width of 1 column

   
    $column_width = $width / $columns;

// Generate the image variables

    


    $im = imagecreate($width,$height);
    $gray = imagecolorallocate($im, 192,192,192);
    $white = imagecolorallocate($im,255,255,255);
    $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
    $gray_dark = imagecolorallocate ($im,0x7f,0x7f,0x7f);
    $black = imagecolorallocate($im, 15,15,15);
    
// Fill in the background of the image

    
    imagefilledrectangle($im,0,0,$width,$height,$white);
    $maxv = 0;

// Calculate the maximum value we are going to plot

    for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);
// Now plot each column
        
    for($i=0;$i<$columns;$i++){
        $column_height= ($height/100) * (($values[$i] / $maxv) * 100);
        $x1 = $i*$column_width;
        $y1 = $height - $column_height;
        //$y1 = $height-$column_height;
        $x2 = (($i+1)*$column_width)-$padding;

        $y2 = $height;

        

        imagefilledrectangle($im,$x1,$y2,$x2,$y1,$gray);
        imagestring($im, $padding, $x1+20 ,$y1, "".$values[$i], $black);
        imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
        imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
        imageline($im,$x2,$y1,$x2,$y2,$gray_dark);
    }
    


// This part is just for 3D effect

       /* */
        

    

// Send the PNG header information. Replace for JPEG or GIF or whatever
   ob_start();
    //header ("Content-type: image/png");
    imagepng($im);
    $img_src = "data:image/png;base64," . base64_encode(ob_get_contents());
  ob_end_clean(); 
  imagedestroy($im);
  
    
?>