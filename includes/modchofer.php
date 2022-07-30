<?php

$idSolic = $_POST["idSolic"];
$cedula1 = $_POST["cedula1"];
$cedula2 = $_POST["cedula2"];
$cedula = "$cedula1$cedula2";
$nombre = $_POST["nombre"];
$dirreccion = $_POST["dirreccion"];
$telf = $_POST["telf"];

$sqlchofer = mysqli_query($link, "SELECT * FROM chofer WHERE id='$idSolic'");
$choferid = mysqli_fetch_assoc($sqlchofer);
$chofer = $choferid["cedula"];

if(mysqli_query($link,"UPDATE chofer SET cedula='$cedula', nombreCompleto='$nombre', dirreccion='$dirreccion', telf='$telf' WHERE id='$idSolic'")){
	if(mysqli_query($link,"UPDATE solicitud SET chofer='$cedula' WHERE chofer='$chofer'")){
		echo '<script>alert("Chofer modificado con exito");</script>';
	}
}else{
	echo '<script>alert("no");</script>';
}

?>