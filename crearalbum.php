<?php
  $title= "Crear Album";
  include("includes/head.php");
  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
    exit;
  }
  include("includes/headerC.php");


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
          include_once("includes/paises.php");
        ?>
      </select>
    </p>

    <input type="submit" value="Crear" class="boton"/>
  </form>
</main>

<?php include("includes/footer.php");?>
