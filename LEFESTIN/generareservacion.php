<?php

include('conectarbase/funciones.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LE FESTIN</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">LE FESTIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Inicio</a>
          </li>          
        </ul>
      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 order-lg-1">
<br>
<br>
<br>
<br>
<br>
<br>
<h1>Estás generando una nueva reservación.</h1>
<br>
<br>
<div class="container col-lg-6">
	<div class="alert alert-success"  id="mensajeexitoso" style="display:none;">
		Se ha reservado exitosamente.
	</div>
<form id="formpost" action="insertarreserva.php" method="POST" onsubmit="return agregaReserva();">
	<b>Fecha:</b><input type="date" name="fecha" class="form-control"><br>
	<b>Hora:</b><input type="time" name="hora" class="form-control"><br>
	<b>Cliente:</b><select name="cliente" class="form-control">
   
   <?php
    $consultarcliente = "SELECT * FROM clientes";
  try {
    $consultarclienteexc = Database::getInstance()->getDb()->prepare($consultarcliente);
    $consultarclienteexc->execute();
    $contarclientes = $consultarclienteexc->rowCount();
  } catch (PDOException $e) {
    echo 'Error';
  }
  while($arraycliente = $consultarclienteexc->fetch(PDO::FETCH_ASSOC)){
    echo '<option value="'.$arraycliente['idclientes'].'">'.$arraycliente['nombre_clien'].' '.$arraycliente['apellido_clien'].'</option>';
  }

   ?> 
  </select>
  <a href="generacliente.php">Si el cliente no existe, puede agregar uno haciendo click acá</a>
	<br>

  <b>Cantidad por Mesa:</b>
  <input type="number" name="cantidadmesa" placeholder="Ejemplo: 5" class="form-control">
  <br>
  <br>
	
	<center><input type="submit" class="btn btn-primary" value="Generar Reservación"></center>
	<br>
	<br>
	
</form>

<script>
function agregaReserva(){
    var url = 'insertarreserva.php';
    $.ajax({
        type:'POST',
        url:url,
        data:$('#formpost').serialize(),
        success: function(data){
            $('#formpost')[0].reset();
            $("#mensajeexitoso").show();
        }
    });
    return false;
}
	</script>
</div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; LE FESTIN by Anniel Castellano</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
