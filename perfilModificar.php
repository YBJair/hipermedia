<?php
  $title= "Perfil";
  include("includes/head.php");
  include("includes/headerL.php");

  if(isset($_SESSION["remember"])==false){
	  	header("location: index.php");
	}
?>


<?php include("includes/footer.php");?>