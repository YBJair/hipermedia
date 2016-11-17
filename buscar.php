<?php
$title= "Busqueda";
include("includes/head.php");
include("includes/headerL.php");

if(isset($_SESSION["remember"])==true){
  header("location: buscarconectado.php");
}
?>
<form action="resultado.php" method="GET" class="formM">
  <label for="title">Título: </label><input id="title" class="text" name="titulo" type="text" value="<?php if(isset($_GET["busqueda"]))echo $_GET["busqueda"]; ?>" required/>
  <br>
  <label for="fechaB">Fecha: </label><input id="fechaB" type="date" name="fecha"/>
  <br>

  <label for="country">Pais: </label>
  <select id="country" name="pais">
    <?php

    //Buscamos los paises en la BBDD
    $resultado = mysqli_query($bbdd, 'SELECT * from paises');
    while ($fila=$resultado->fetch_assoc()){

      $nombre= $fila['NomPais'];
      $id= $fila['idPais'];

      echo "<option value='$id'>$nombre</option>\n";
    }



    ?>
  </select>

  <br>
  <input type="submit" class="boton" value="Buscar"/>
</form>

<?php include("includes/footer.php");?>
