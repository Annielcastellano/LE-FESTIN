<?php 
include('conectarbase/funciones.php');

$idreserva = htmlentities($_POST['idreserva']);



$borrar = "DELETE FROM reservaclientes WHERE idreservaciones1 = :idreserva";
try {
$insertarexc = Database::getInstance()->getDb()->prepare($borrar);
$insertarexc->bindParam(':idreserva',$idreserva);
$insertarexc->execute();
	
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}


$borrar2 = "DELETE FROM reservaciones WHERE idreservaciones = :idreserva";
try {
$insertarexc2 = Database::getInstance()->getDb()->prepare($borrar2);
$insertarexc2->bindParam(':idreserva',$idreserva);
$insertarexc2->execute();
	
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}


if($insertarexc == true){
	echo 'ok';
	return true;
}
?>