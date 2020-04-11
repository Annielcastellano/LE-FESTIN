<?php 
include('conectarbase/database.php');

class llamarCliente{

function infoCliente($id){
	 $consultarcliente = "SELECT * FROM clientes WHERE idclientes = :id";
  try {
    $consultarclienteexc = Database::getInstance()->getDb()->prepare($consultarcliente);
    $consultarclienteexc->bindParam(':id',$id);
    $consultarclienteexc->execute();
    $arraycliente = $consultarclienteexc->fetch(PDO::FETCH_ASSOC);

    $porretornar = "".$arraycliente['nombre_clien']." ".$arraycliente['apellido_clien']."";
  } catch (PDOException $e) {
    echo 'Error';
  }

  return $porretornar;
}
}
?>

