<?php

$matricula = $_POST["matricula"];
$capacidad = $_POST["capacidad"];
$tipo = $_POST["tipo"];

if(mysqli_query($link,"INSERT INTO veiculo(matricula, capacidad, tipo, estado) VALUES('$matricula','$capacidad','$tipo', 'Habilitado')")){
	echo '<script>alert("Veiculo registrado con exito");</script>';
}else{
	echo '<script>alert("no");</script>';
}

?>