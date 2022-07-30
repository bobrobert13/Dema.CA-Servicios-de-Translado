<?php

$nombre = $_POST["nombreCompleto"];
$correo = $_POST["correo"];
$usuario = $_POST["nombreUsuario"];
$contra = $_POST["contrasena"];
$reContra = $_POST["reContrasena"];

$checkmail = mysqli_query($link, "SELECT * FROM usuarios WHERE correo='$correo'");
$checkrow = mysqli_num_rows($checkmail);
$checkname = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreUsuario='$usuario'");
$checkrow2 = mysqli_num_rows($checkname);

if($contra == $reContra){
	if($checkrow>0){
		echo '<script>alert("Correo esta en uso");</script>';
	}else{
		if($checkrow2>0){
			echo '<script>alert("nombre de usuario esta en uso");</script>';
		}else{
			if(mysqli_query($link,"INSERT INTO usuarios(nombreCompleto,correo,nombreUsuario,contrasena,estado) VALUES('$nombre','$correo','$usuario','$contra','Habilitado')")){
				echo '<script>alert("Usuario registrado con exito");</script>';
			}else{
				echo '<script>alert("no");</script>';
			}
		}
	}
}else{
	echo '<script>alert("Contraseñas no coinciden");</script>';
}


?>