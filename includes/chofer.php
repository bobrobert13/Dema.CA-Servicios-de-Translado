<?php

$cedula1 = $_POST["cedula1"];
$cedula2 = $_POST["cedula2"];
$cedula = "$cedula1$cedula2";
$nombre = $_POST["nombre"];
$dirreccion = $_POST["dirreccion"];
$telf = $_POST["telf"];

if(mysqli_query($link,"INSERT INTO chofer(cedula, nombreCompleto, dirreccion, telf, estado) VALUES('$cedula','$nombre','$dirreccion','$telf','Habilitado')")){
	echo '<script>alert("Chofer registrado con exito");</script>';
}else{
	echo '<script>alert("no");</script>';
}

?>