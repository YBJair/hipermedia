<?php
  $title= "Solicitar Album";
  include("includes/head.php");
  include("includes/headerC.php");

  if(isset($_SESSION["remember"])==false){
    header("location: index.php");
    exit;
    }

  if(!isset($_GET["id"])){
      header("location: index.php");
  } else {
      $idAlbum = $_GET["id"];
      $sentencia = "SELECT a.Titulo, f.Titulo as fTitulo, f.Fichero
                from albumes a, fotos f
                where a.idAlbum = $idAlbum and f.Album = $idAlbum"
  }

  ?>

  <?php include("includes/footer.php");?>