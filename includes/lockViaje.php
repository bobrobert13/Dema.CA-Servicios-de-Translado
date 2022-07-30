<?php 

include("session.php");

$idSolicitud = $_POST['idSolicitud'];

$sqlHabi = mysqli_query($link, "SELECT estado FROM solicitud WHERE id='$idSolicitud'");
$habilitado = mysqli_fetch_assoc($sqlHabi);

if($habilitado['estado'] == "Finalizado"){
	if(mysqli_query($link, "UPDATE solicitud SET estado='Activo' WHERE id='$idSolicitud'")){
			header("location: ../mainpage.php");
	}
	echo "1";
}elseif($habilitado['estado'] == "Activo"){
	$resultado = mysqli_query($link,"UPDATE solicitud SET estado='Finalizado' WHERE id='$idSolicitud'");
		if(!$resultado){
			die('Consulta no válida: ' . mysqli_error($link));
		}
	if(mysqli_query($link, "UPDATE solicitud SET estado='Finalizado' WHERE id='$idSolicitud'")){
			header("location: ../mainpage.php");
	}
}else{
	header("location: ../mainpage.php");
}
?>