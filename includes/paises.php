<?php /*Buscamos los paises en la BBDD*/
    $resultado = mysqli_query($bbdd, 'SELECT NomPais, idPais from paises');
    while ($fila=$resultado->fetch_assoc()){

      $nombre= $fila['NomPais'];
      $id= $fila['idPais'];

      echo "<option value=$id>$nombre</option>\n";
    }
    ?>
