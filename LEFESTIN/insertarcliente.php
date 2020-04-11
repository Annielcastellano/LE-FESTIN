<?php 
include('conectarbase/funciones.php');

$nombre = htmlentities($_POST['nombre']);
$apellido = htmlentities($_POST['apellido']);
$telef = htmlentities($_POST['telef']);


$insertarcliente = "INSERT INTO clientes (nombre_clien, apellido_clien, telefono) VALUES (:nombre,:apellido,:telf)";
try {
$insertarexc = Database::getInstance()->getDb()->prepare($insertarcliente);
$insertarexc->bindParam(':nombre',$nombre);
$insertarexc->bindParam(':apellido',$apellido);
$insertarexc->bindParam(':telf',$telef);
$insertarexc->execute();
	
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}

if($insertarexc == true){
	echo 'ok';
	return true;
}
?>