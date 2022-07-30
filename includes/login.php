<?php

$link = mysqli_connect('localhost', 'root', '', 'demacabd');

$nombre = $_POST["usuario"];
$contra = $_POST["contrasena"];

$check1 = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreUsuario='$nombre'");
$ejecCheck1 = mysqli_num_rows($check1);
if($ejecCheck1 == 0){
	echo '<script>alert("Usuario no existente");</script>';
}else{
	$check2 = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreUsuario='$nombre' AND estado='Deshabilitado'");
	$ejecCheck2 = mysqli_num_rows($check2);
	if($ejecCheck2 >= 1){
		echo '<script>alert("Usuario deshabilitado");</script>';
	}else{
		$check3 = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreUsuario='$nombre' AND contrasena='$contra'");
		$ejecCheck3 = mysqli_num_rows($check3);
		if($ejecCheck3 >= 1){
			session_start();
			if($_SESSION["user"] = $nombre){
				header("location: mainpage.php?");
			}
		}else{
			echo '<script>alert("Usuario y contraseña no coinciden");</script>';
		}
	}
}

?>