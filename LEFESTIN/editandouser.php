<?php 
include('conectarbase/funciones.php');

$idclientes = htmlentities($_POST['idclientes']);
$nombre = htmlentities($_POST['nombre_clien']);
$apellido = htmlentities($_POST['apellido_clien']);
$clientescol = htmlentities($_POST['telefono']);



$borrar = "UPDATE clientes SET nombre_clien = :nombre, apellido_clien = :apellido, telefono = :telefono WHERE idclientes = :idclientes";
try {
$insertarexc = Database::getInstance()->getDb()->prepare($borrar);
$insertarexc->bindParam(':idclientes',$idclientes);
$insertarexc->bindParam(':nombre',$nombre);
$insertarexc->bindParam(':apellido',$apellido);
$insertarexc->bindParam(':telefono',$clientescol);
$insertarexc->execute();
	
} catch (PDOException $e) {
	echo 'Error'.$e->getMessage();
}



if($insertarexc == true){
	echo 'ok';
	return true;
}
?>