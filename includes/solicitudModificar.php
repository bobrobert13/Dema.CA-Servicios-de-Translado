<?php
$idSolic = $_POST["idSolic"];
$nombrePasajero = $_POST["nombrePasajeroM"];
$chofer = $_POST["choferM"];
$fechaChofer = $_POST["fechaChoferM"];
$veiculo = $_POST["veiculoM"];
$horaVeiculo = $_POST["horaVeiculoM"];
$detalles = $_POST["detallesM"];

$sql = "UPDATE solicitud SET nombrePasajero='$nombrePasajero', chofer='$chofer', fechaChofer='$fechaChofer', veiculo='$veiculo', horaVeiculo='$horaVeiculo', detalles='$detalles' WHERE id='$idSolic'";

if(mysqli_query($link, $sql)){
	echo '<script>alert("Solicitud modificada con exito");</script>';
}else{
	echo '<script>alert("no");</script>';
}


?>