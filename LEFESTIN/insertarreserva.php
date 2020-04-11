<?php 
include('conectarbase/funciones.php');

$fecha = new Datetime($_POST['fecha']);
$fecha2 = $fecha->format('Y-m-d');
$hora = htmlentities($_POST['hora']);
$cantidadmesa = htmlentities($_POST['cantidadmesa']);
$cliente = htmlentities($_POST['cliente']);


$insertarreserva = "INSERT INTO reservaciones (fecha_reserva, hora, cantidad_mesa) VALUES (:fecha,:hora,:cantidadmesa)";
try {
$insertarexc = Database::getInstance()->getDb()->prepare($insertarreserva);
$insertarexc->bindParam(':fecha',$fecha2);
$insertarexc->bindParam(':hora',$hora);
$insertarexc->bindParam(':cantidadmesa',$cantidadmesa);
$insertarexc->execute();
$ultimoid = Database::getInstance()->getDb()->lastInsertId();
	
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}

$insertarenclientes = "INSERT INTO reservaclientes (idclientes2, idreservaciones1) VALUES (:cliente,:ultimoid)";
try {
	$insertarenclientesexc = Database::getInstance()->getDb()->prepare($insertarenclientes);
	$insertarenclientesexc->bindParam(':cliente',$cliente);
	$insertarenclientesexc->bindParam(':ultimoid',$ultimoid);
	$insertarenclientesexc->execute();
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}

if($insertarexc == true){
	echo 'ok';
	return true;
}
?>