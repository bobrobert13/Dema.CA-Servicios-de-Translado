<?php

$idSolic = $_POST["idSolic"];
$matricula = $_POST["matricula"];
$capacidad = $_POST["capacidad"];
$tipo = $_POST["tipo"];

if(mysqli_query($link,"UPDATE veiculo SET matricula='$matricula', capacidad='$capacidad', tipo='$tipo' WHERE id='$idSolic'")){
	echo '<script>alert("Veiculo modificado con exito");</script>';
}else{
	echo '<script>alert("no");</script>';
}

?>