<?php
  $title= "Respuesta Album";
  include("includes/head.php");

  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
    exit;
  }
  include("includes/headerC.php");
?>
  <main>
    <p> The request for an album has been accepted. The total cost is 6.66€ </p>
  </main>

</body>
</html>
