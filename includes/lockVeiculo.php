<?php

include("session.php");

$idVeiculo = $_POST['idVeiculo'];

$sqlHabi = mysqli_query($link, "SELECT estado FROM veiculo WHERE id='$idVeiculo'");
$habilitado = mysqli_fetch_assoc($sqlHabi);

if($habilitado['estado'] == "Deshabilitado"){
	if(mysqli_query($link, "UPDATE veiculo SET estado='Habilitado' WHERE id='$idVeiculo'")){
			header("location: ../veiculo.php?p=3");
	}
}elseif($habilitado['estado'] == "Habilitado"){
	if(mysqli_query($link, "UPDATE veiculo SET estado='Deshabilitado' WHERE id='$idVeiculo'")){
			header("location: ../veiculo.php?p=3");
	}
}else{
	header("location: ../veiculo.php?p=3");
}

?>