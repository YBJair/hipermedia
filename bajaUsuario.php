<?php
  $title= "Perfil";
 include("includes/head.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
      exit;
	}

  include("includes/headerC.php");

  if (isset($_GET["error"])) {
    echo "<h3 class='index'>";
    switch($_GET["error"]){
        case 0:
        echo "No ha confirmado el borrado con el mensaje adecuado";
        break;
        case 1:
        echo "Contraseña incorrecta";
        break;
        default:
        echo "error desconocido";
        break;
    }
    echo "</h3>";
  }
  ?>
<main>
    <p>¿Realmente quiere borrar su cuenta? No se podrá recuperar en un futuro</p>
    <p>Si realmente quiere borrar su cuenta escriba "BORRAR"</p>
    <form action="index.php" method="POST">
        <p><label for="borrar">Confirmación:</label> <input type="text" name="borrar" id="borrar"></p>
        <p><label for="pass">Contraseña:</label> <input type="password" name="pass" id="pass"></p>
        <p><button type="submit" name=button>Borrar</button></p>
    </form>
    <form action="menuperfil.php">
        <button type="submit">Cancelar</button>
    </form>
</main>


  <?php 
    include("includes/footer.php");
  ?>