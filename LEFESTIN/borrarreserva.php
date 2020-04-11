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
<h1>Vas a borrar esta reservación</h1>
<br>
<br>
<div class="container col-lg-6">

<?php


if(isset($_GET['id'])){
  $idreserva = htmlentities($_GET['id']);
$consultarreserva = "SELECT * FROM reservaclientes WHERE idreservaciones1 = :idreserva";
    $consultarreservaexc = Database::getInstance()->getDb()->prepare($consultarreserva);
    $consultarreservaexc->bindParam(':idreserva',$idreserva);
    $consultarreservaexc->execute();
    $contarreserva = $consultarreservaexc->rowCount();
}



?>

<br>
<div class="alert alert-success" id="mensajeexitoso" style="display:none;">Reservación borrada exitosamente. Serás redireccionado de vuelta en 3 segundos.</div>
<br>
<br>

<table class="table">
<thead>
  <th>Cliente</th>
  <th>Fecha Reserva</th>
  <th>Hora</th>
  <th>Cantidad de Personas</th>
</thead>
<tbody>
  <?php
  while($arrayreserva = $consultarreservaexc->fetch(PDO::FETCH_ASSOC)){

      $idcliente = $arrayreserva['idclientes2'];
    $consultareservacion = "SELECT * FROM reservaciones WHERE idreservaciones = :reservacion";
    try {
      $consultareservacionexc = Database::getInstance()->getDb()->prepare($consultareservacion);
      $consultareservacionexc->bindParam(':reservacion',$arrayreserva['idreservaciones1']);
      $consultareservacionexc->execute();
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
  </tr>
  ';
}}
  ?>
</tbody>
</table>

<form action="" method="post" id="formpost" onsubmit="return borrarReserva()">
  <input type="hidden" name="idreserva" value="<?php echo $_GET['id'];?>" >
  <input type="submit" class="btn btn-secondary" value="Confirmar Borrado de Reservación" style="background:red">
</form>
<br><br><br>
<script>
function borrarReserva(){
    var url = 'borradodereserva.php';
    $.ajax({
        type:'POST',
        url:url,
        data:$('#formpost').serialize(),
        success: function(data){
            $('#formpost')[0].reset();
            $("#mensajeexitoso").show();
            if(data){
              setTimeout("location.href='verreservaciones.php'",3000);
            }
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
