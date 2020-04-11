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
<h1>Estás viendo las reservaciones actuales</h1>
<br>
<br>
<div class="container col-lg-6">

<?php


if(isset($_GET['idclientes'])){
  $idclientes = htmlentities($_GET['idclientes']);
$consultarreserva = "SELECT * FROM reservaclientes WHERE idclientes2 = :idclientes";
    $consultarreservaexc = Database::getInstance()->getDb()->prepare($consultarreserva);
    $consultarreservaexc->bindParam(':idclientes',$idclientes);
    $consultarreservaexc->execute();
    $contarreserva = $consultarreservaexc->rowCount();
}
else{
$consultarreserva = "SELECT * FROM reservaclientes ";
    $consultarreservaexc = Database::getInstance()->getDb()->prepare($consultarreserva);
    $consultarreservaexc->execute();
    $contarreserva = $consultarreservaexc->rowCount();
 
}

 $consultarcliente = "SELECT * FROM clientes";
  try {
    $consultarclienteexc = Database::getInstance()->getDb()->prepare($consultarcliente);
    $consultarclienteexc->execute();
    $contarclientes = $consultarclienteexc->rowCount();
  } catch (PDOException $e) {
    echo 'Error';
  }

?>

<br><br>
<div class="" style=""><b>Buscar por cliente:</b><br><form action="" method="GET">
<select name="idclientes" class="form-control" style="width:50%;display: inline-block;">
  <?php while($arraycliente = $consultarclienteexc->fetch(PDO::FETCH_ASSOC)){
echo '<option value="'.$arraycliente['idclientes'].'">'.$arraycliente['nombre_clien'].' '.$arraycliente['apellido_clien'].'</option>';
}
    ?>
</select>

  <input class="btn btn-primary" type="submit" value="Buscar"></div></form><br> 
<a href="verreservaciones.php" class="btn btn-secondary">Ver todas las reservaciones</a>
<br>
<br>

<table class="table">
<thead>
  <th>Cliente</th>
  <th>Fecha Reserva</th>
  <th>Hora</th>
  <th>Cantidad de Personas</th>
  <th>Acciones</th>
</thead>
<tbody>
  <b>Total reservas encontradas: <?php echo $contarreserva;?></b>
  <?php
  while($arrayreserva = $consultarreservaexc->fetch(PDO::FETCH_ASSOC)){

    $consultareservacion = "SELECT * FROM reservaciones WHERE idreservaciones = :reservacion";
    try {
      $consultareservacionexc = Database::getInstance()->getDb()->prepare($consultareservacion);
      $consultareservacionexc->bindParam(':reservacion',$arrayreserva['idreservaciones1']);
      $consultareservacionexc->execute();
      $idcliente = $arrayreserva['idclientes2'];
    } catch (PDOException $e) {
      echo 'Error';
    }

  
  while($arrayreservacion = $consultareservacionexc->fetch(PDO::FETCH_ASSOC)){
    $formatofecha = new DateTime($arrayreservacion['fecha_reserva']);
    $fechanew = $formatofecha->format('d-m-Y');
    $hora =  date('G:i',strtotime($arrayreservacion['hora']));
    $llamarcliente = new llamarCliente;
echo'
<tr>
  <td>'.$llamarcliente->infoCliente($idcliente).'</td>
  <td>'.$fechanew.'</td>
  <td>'.$hora.'</td>
  <td>'.$arrayreservacion['cantidad_mesa'].'</td>
  <td><a href="borrarreserva.php?id='.$arrayreservacion['idreservaciones'].'">Borrar</a></td>
  </tr>
  ';
}}
  ?>
</tbody>
</table>

<script>
function agregaRegistro(){
    var url = 'insertarcliente.php';
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
