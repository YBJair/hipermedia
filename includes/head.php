<?php
session_start();
$bbdd = @mysqli_connect(
        'localhost', //server
        'user',
        'root',
        'pibd'  //bbdd
      );
      mysqli_set_charset($bbdd, 'utf8');
      if(!$bbdd){
        echo '<p> Error en base de datos: ' . mysqli_connect_error();
        echo '</p>';
        exit;
      }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="css/estiloMin.css" type="text/css" media="(max-width: 1044px)"/>
    <link rel="stylesheet" href="css/estilo.css" type="text/css" media="(min-width: 1045px)"/>
    <link rel="alternate stylesheet" href="css/accesible.css" media="screen" title="no title">
    <link rel="stylesheet" href="css/impresion.css" type="text/css" media="print"/>
  </head>
  <body>
