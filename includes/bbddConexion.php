$bbdd = @mysqli_connect(
          'localhost', //server
          'user', 
          'root',
          'pibd'  //bbdd
        );
        if(!$bbdd){
          echo '<p> Error en base de datos: ' . mysqli_connect_error();
          echo '</p>\n';
          exit;
        }