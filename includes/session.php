<?php

$link = mysqli_connect('localhost', 'root', '', 'demacabd');

session_start();

if(isset($_SESSION["user"])){
	$ses = $_SESSION["user"];
	$checksession = mysqli_query($link, "SELECT estado FROM usuarios WHERE nombreUsuario='$ses'");
	$checksessionrow = mysqli_num_rows($checksession);
	$level = mysqli_fetch_assoc($checksession);
	if($checksessionrow == 1){
		
	}else{
		header("location: index.php");
	}
}else{
	header("location: index.php");
}

?>