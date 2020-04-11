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
<h1>Editando Usuario</h1>
<br>
<br>
<div class="container col-lg-6">

<?php


if(isset($_GET['id'])){
  $idcliente = htmlentities($_GET['id']);
$consultarreserva = "SELECT * FROM clientes WHERE idclientes = :idcliente";
    $consultarreservaexc = Database::getInstance()->getDb()->prepare($consultarreserva);
    $consultarreservaexc->bindParam(':idcliente',$idcliente);
    $consultarreservaexc->execute();
    $arrayuser = $consultarreservaexc->fetch(PDO::FETCH_ASSOC);
}



?>

<br>
<div class="alert alert-success" id="mensajeexitoso" style="display:none;">Usuario Actualizado Exitosamente. Serás redireccionado de vuelta en 3 segundos.</div>


<form action="" method="post" id="formpost" onsubmit="return editarUser()">
  <input type="hidden" name="idclientes" value="<?php echo $_GET['id'];?>" >
  <input type="text" name="nombre_clien" placeholder="Nombre" value="<?php echo $arrayuser['nombre_clien']?>" class="form-control">
  <br>
  <input type="text" name="apellido_clien" placeholder="Apellido" value="<?php echo $arrayuser['apellido_clien']?>" class="form-control">
  <br>
  <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $arrayuser['telefono']?>" class="form-control">
  <br>
  <input type="submit" class="btn btn-secondary" value="Actualizar Usuario" style="background:red">
</form>
<br><br><br>
<script>
function editarUser(){
    var url = 'editandouser.php';
    $.ajax({
        type:'POST',
        url:url,
        data:$('#formpost').serialize(),
        success: function(data){
            $("#mensajeexitoso").show();
            if(data){
              setTimeout("location.href='verclientes.php'",3000);
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
