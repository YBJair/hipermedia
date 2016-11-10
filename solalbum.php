<?php
  $title= "Solicitar Album";
  include("includes/head.php");
  include("includes/headerC.php");

  if(isset($_SESSION["remember"])==false){
		header("location: index.php");
	}
?>
<p id="explicacion"> Mediante este formulario puedes solicitar un album en color o en blanco y negro.</p>
<main>

  <article id="tarifas">
    <h2>Tabla de tarifas</h2>
    <table id="tableTarifas">
      <thead>

        <tr>
          <td>Concepto </td>
          <td>Tarifa </td>
        </tr>

      </thead>
      <tr>
        <td> &lt; 5 páginas </td>
        <td> 0.10€ por página</td>
      </tr>
      <tr>
        <td> 5-10 páginas </td>
        <td> 0.08€ por página </td>
      </tr>
      <tr>
        <td> &gt; 11 páginas</td>
        <td> 0.07€ por página </td>
      </tr>
      <tr>
        <td>Blanco y negro</td>
        <td>0€</td>
      </tr>
      <tr>
        <td>Color</td>
        <td>0.05€ por foto</td>
      </tr>
      <tr>
        <td>Resolución &gt; 300 dpi</td>
        <td>0.02€ por foto</td>
      </tr>
    </table>
  </article>
  <article id="formRegistro">
    <h2> Formulario</h2>
    <p>Los campos marcados con (*) son obligatorios</p>
    <form autocomplete="on" action="respalbum.php" method="POST">
      <p>
        <label for="name">Nombre: </label>
        <input id="name" placeholder="nombre" name="name" type="text"  required autofocus/>(*)
      </p>
      <p>
        <label for="title">Título del álbum: </label>
        <input id="title" placeholder="descripción" name="title" type="text" required/>(*)
      </p>
      <p>
        <label for="additional">Texto adicional: </label>
        <input id="additional" name="additional text" type="text" />
      </p>
      <p>
        <label for="email">Email: </label>
        <input id="email" name="email" type="email" placeholder="example@gmail.com" required/>(*)
      </p>
      <p>
        <label for="address">Dirección: </label>
        <input id="address" name="street" type="text" placeholder="Calle" required/>
        <input id="numberAddress" name="numberadd" type="number" placeholder="Número" required/>
        <input id="cp" name="cp" type="number"  placeholder="CP"  required/>
        <select id="city" name="city"  required>
          <option value=""></option>
          <option value="Meh"> Meh </option>
        </select>
        <select id="province" name="province" required>
          <option value=""></option>
          <option value="Elche"> Elche</option>
          <option value="Meh"> Meh </option>
        </select>(*)
      </p>
      <p>
        <label for="tel"> Telefono: </label>
        <input id="tel" name="telephone" placeholder="+## ### ## ## ##" type="tel"
        pattern="(\+[0-9]{2}) [0-9]{9}" title="Prefix + your number (+## ### ## ## ##)" />

      </p>
      <p>
        <label for="color"> Color de la portada: </label>
        <input id="color" name="color" type="color" value="#444444" required/>
      </p>
      <p>
        <label for="numCop"> Número de copias </label>
        <input id="numCop" name="numbercopies" type="number" value="1" min="1" />(*)
      </p>
      <p>
        <label for="resolution"> Resolucion de impresión: </label>
        <input id="resolution" type="range" name="resolution" min="150" max="900" step="150">(*)
      </p>
      <p>
        <label for="album">Álbum de PI: </label>
        <select id="album" name="album" required>
          <option value=""></option>
          <option value="1"> Finchingo</option>
          <option  value="2"> Pinchipopi</option>
        </select>(*)
      </p>
      <p>
        <label for="receip"> Fecha de recibo: </label>
        <input type="date" id="receip" name="receip" />
      </p>
      <p>
        <label> ¿Imprimir a color? </label>
        <input type="radio" id="colorprint" name="colorprint" value="color">
        <label for="colorprint"> Si </label>
        <input type="radio" id="black" name="radioprint" value="black">
        <label for="black">No </label>
      </p>
      <button type="submit" >Aceptar </button>

    </form>
  </article>

</main>

<?php include("includes/footer.php");?>
