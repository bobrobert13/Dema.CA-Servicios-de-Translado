<?php

$nombrePasajero = $_POST["nombrePasajero"];
$chofer = $_POST["chofer"];
$fechaChofer = $_POST["fechaChofer"];
$veiculo = $_POST["veiculo"];
$horaVeiculo = $_POST["horaVeiculo"];
$detalles = $_POST["detalles"];
$estado = "Activo";
$fechaTransito = date("Y-m-d");

$sql = "INSERT INTO 
solicitud(nombrePasajero, chofer, fechaChofer, veiculo, horaVeiculo, detalles, estado, fechaTransito) 
VALUES('$nombrePasajero', '$chofer', '$fechaChofer', '$veiculo', '$horaVeiculo','$detalles', '$estado', '$fechaTransito')";

if(mysqli_query($link, $sql)){
	echo '<script>alert("Solicitud registrada con exito");</script>';
}else{
	echo '<script>alert("no");</script>';
}


?>