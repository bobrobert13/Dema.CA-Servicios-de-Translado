<?php

include("session.php");

$idUsuario = $_POST['idUsuario'];

$sqlHabi = mysqli_query($link, "SELECT estado FROM usuarios WHERE id='$idUsuario'");
$habilitado = mysqli_fetch_assoc($sqlHabi);

if($habilitado['estado'] == "Deshabilitado"){
	if(mysqli_query($link, "UPDATE usuarios SET estado='Habilitado' WHERE id='$idUsuario'")){
			header("location: ../opciones.php?p=4");
	}
}elseif($habilitado['estado'] == "Habilitado"){
	if(mysqli_query($link, "UPDATE usuarios SET estado='Deshabilitado' WHERE id='$idUsuario'")){
			header("location: ../opciones.php?p=4");
	}
}else{
	header("location: ../opciones.php?p=4");
}

?>