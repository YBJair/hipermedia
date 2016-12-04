<?php
$sql= "SELECT titulo, idAlbum FROM albumes";
$resalbum=mysqli_query($bbdd, $sql);
if($resalbum!=false && !mysqli_error($bbdd)){
  while ($filaalbum = $resalbum->fetch_assoc()) {
    $tituloa=$filaalbum['titulo'];
    $ida= $filaalbum['idAlbum'];
      echo "\n<option value=$ida>$tituloa</option>";
  }
}
?>
