<?php
  $title= "Busqueda";
  include("includes/head.php");
  include("includes/headerC.php");

  
  if(isset($_SESSION["remember"])==false){
		header("location: buscar.php");
	}
?>
<form action="resultadoconectado.php" method="GET" class="formM">
  <label for="title">Título: </label><input id="title" class="text" name="titulo" type="text" value="<?php if(isset($_GET["busqueda"]))echo $_GET["busqueda"]; ?>" required/>
  <br>
  <label for="fechaB">Fecha: </label><input id="fechaB" type="date" name="fecha"/>
  <br>

  <label for="country">Pais: </label>
  <select id="country" name="pais">
    <?php include("includes/paises.php"); ?>
  </select>

  <br>
  <input type="submit" class="boton" value="Buscar"/>
</form>

<?php include("includes/footer.php");?>
