          <?php
          $filtroUser = "/[^[:alnum:]]/"; //Alfabeto ingles y numeros (negativo)
          $filtroPass1 = "/[^[:alnum:]_]/"; //Alfabeto ingles, numeros y barra baja (negativo)
          $filtroPassMayu = "/[[:upper:]+]/"; //Obligatorio una mayuscula 
          $filtroPassMinu = "/[[:lower:]+]/"; //Obligatorio una minuscula
          $filtroPassNum = "/[0-9+]/"; //Obligatorio un numero
          $filtroEmail = "/.+@.+\..{2,4}$/"; //Patron tipico de email (ddd@ff.ff) maximo 4 en el dominio global y minimo 2
          $filtroFecha = "/[0-3][0-9]-[01][0-9]-[0-9]{4}/"; //Comprueba que la fecha tenga un formato adecuado
          $filtroFechaMes = "/^.{3}1[3-9]/"; //Comprueba que el mes no este entre 13 y 19
          $filtroFechaMes2 = "/^.{3}00/"; //Comprueba que el mes no sea 00
          $filtroFechaDia = "/^00/"; //Comprueba que el dia no sea 00
          $filtroFechaFebrero = "/^3[01]-02/"; //Comprueba que febrero sea especialito como siempre
          ?>