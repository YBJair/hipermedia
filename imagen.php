<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Imagen</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="css/estiloMin.css" type="text/css" media="(max-width: 1044px)"/>
  <link rel="stylesheet" href="css/estilo.css" type="text/css" media="(min-width: 1045px)"/>
  <link rel="stylesheet" href="css/impresion.css" media="print"/>
</head>
<body>
  <header class="text">
    <a id="logo" href="index.php" ><img src="images/logo.jpg" alt="logo"/></a>

    <form action="buscar.php" method="POST" class="search">

      <label for="search">Buscar: </label><input id="search"  placeholder="Busqueda" name="Busqueda" type="search" autofocus/>
      <button type="submit"> <i class="material-icons">search</i></button>

    </form>

    <div class="loginF">
      <!--a class="boton" href="" id="butt">Entrar</a-->
      <form action="indexConectado.php" method="POST" class="">
        <label for="user">Usuario: </label><input  id="user" name="User" type="text" placeholder="Usuario" required/>
        <label for="pass">Contraseña: </label><input id="pass"  name="Password" type="password" placeholder="Contraseña" required/>
        <button class="boton" type="submit">Entrar</button>
      </form>
      <a class="boton" href="registro.php">Registro</a>
    </div>
  </header>
  <main>

      <h2 id="titulo">Approves</h2>
      <h3 id="fecha">Fecha: 08/04/1994</h3>
      <figure id="detalleImg"><img  src="images/approves.gif" alt="aproves"/></figure>
      <h3>Pais: Spoin</h3>

    <p>
      <h3>Albumes donde aparece</h3>
      <a href="">Album total </a>,<a href=""> Pompito</a>
    </p>

  </main>
  <footer>
    <p>Jesús Hernández Fernández. Email: jhf6@alu.ua.es</p>
    <p>Jair Abel Jiménez Bellocchio. Email: jajb2@alu.ua.es</p>
  </footer>
</body>

</html>
