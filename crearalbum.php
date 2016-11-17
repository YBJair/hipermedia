<?php
  $title= "Crear Album";
  include("includes/head.php");
  include("includes/headerC.php");
  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
	}
?>

<h1 class="index">Crear Album</h1>
<main>
  <form action="crearalbum.php" method="POST">
    <p><label for="title">Usuario: </label><input id="title" name="titulo" type="text" required/></p>
    <p>
      <label for="descripcion">Descripción: </label><input id="descripcion" type="text" name="descripcion" placeholder="descripcion">
    </p>
    <p>
      <label for="date" >Fecha: </label><input id="date" type="date" name="fecha" required>
    </p>
    <p>
      <label for="country">Pais: </label>
      <select id="country" name="country">

        <?php

        //Buscamos los paises en la BBDD
        $resultado = mysqli_query($bbdd, 'SELECT * from paises');
        while ($fila=$resultado->fetch_assoc()){

          $nombre= $fila['NomPais'];
          $id= $fila['idPaises'];

          echo "<option value='$id'>$nombre</option>\n";
        }

        ?>

      </select>
    </p>

    <input type="submit" value="Crear" class="boton"/>
  </form>
</main>

<?php include("includes/footer.php");?>
