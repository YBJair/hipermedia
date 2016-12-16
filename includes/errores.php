<?php
if (isset($_GET["error"])) {
  echo "<h3 class='index'>";
  switch($_GET["error"]){
    case 0:
    echo "Debe enviar todos los datos";
    break;
    case 1:
    echo "El usuario ya esta registrado";
    break;
    case 2:
    echo "Las contraseñas no coinciden";
    break;
    case 3:
    echo "El email no es valido";
    break;
    case 4:
    echo "Carácter/es inválido/s en el nombre de usuario (letras y números)";
    break;
    case 5:
    echo "Carácter/es inválido/s en la contraseña (letras, números y _)";
    break;
    case 6:
    echo "Es necesario como mínimo una mayúscula, una miníscula y un número en la contraseña";
    break;
    case 7:
    echo "Tamaño de contraseña incorrecto, debe tener entre 6 y 15 carácteres";
    break;
    case 8:
    echo "Tamaño de nombre de usuario incorrecto, debe tener entre 3 y 15 carácteres";
    break;
    case 9:
    echo " Fecha no válida";
    break;
    case 10:
    echo "Se ha producido un error en la foto";
    break;
    case 11:
    echo "El fichero introducido no es válido. Debe ser una foto";
    break;
    default:
    echo "error desconocido";
    break;
  }
  echo "</h3>";
}
 ?>
