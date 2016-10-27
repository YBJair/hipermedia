<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Inicio</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  <link rel="stylesheet" href="css/estiloMin.css" type="text/css" media="(max-width: 1044px)"/>
  <link rel="stylesheet" href="css/estilo.css" type="text/css" media="(min-width: 1045px)"/>
  <link rel="stylesheet" href="css/impresion.css" type="text/css" media="print"/>
</head>
<body>
  <header class="text">
    <a href="index.php" id="logo"><img src="images/logo.jpg" alt="logo" /></a>

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
  <h1 class="index"> Tus imágenes donde quieras, cuando quieras</h1>
  <main>
    <!-- Resolucion: 250x167-->
    <article><a href="imagen.php"><img src="images/approves.gif" alt="snoop dog"/></a></article>
    <article><a href=""><img src="images/zetta.gif" alt="gif de la compañia zetta"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>
    <article><a href=""><img src="images/dormitorio.jpg" alt="dormitorio"/></a></article>

  </main>

  <footer>
    <p>Jesús Hernández Fernández. Email: jhf6@alu.ua.es</p>
    <p>Jair Abel Jiménez Bellocchio. Email: jajb2@alu.ua.es</p>
  </footer>

</body>

</html>
