<?php 

include("session.php");

$idChofer = $_POST['idChofer'];

$sqlHabi = mysqli_query($link, "SELECT estado FROM chofer WHERE id='$idChofer'");
$habilitado = mysqli_fetch_assoc($sqlHabi);

if($habilitado['estado'] == "Deshabilitado"){
	if(mysqli_query($link, "UPDATE chofer SET estado='Habilitado' WHERE id='$idChofer'")){
			header("location: ../chofer.php?p=2");
	}
}elseif($habilitado['estado'] == "Habilitado"){
	if(mysqli_query($link, "UPDATE chofer SET estado='Deshabilitado' WHERE id='$idChofer'")){
			header("location: ../chofer.php?p=2");
	}
}else{
	header("location: ../chofer.php?p=2");
}

?>