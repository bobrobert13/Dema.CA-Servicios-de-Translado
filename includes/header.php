<link rel="stylesheet" type="text/css" href="css/header.css">
<?php 
if(!isset($_GET["p"]) or !is_numeric($_GET["p"]) or $_GET["p"]>4 or $_GET["p"]<0){
	$p = 0;
}else{
	$p = $_GET["p"];
}
?>
<div class="topnav">
<?php if($p==0){ ?>
	<a style="background-color:white;color:#6495ED;" href="mainpage.php">Solicitud de traslado</a>
<?php }else{ ?>
	<a href="mainpage.php">Solicitud de traslado</a>
<?php }if($p==1){ ?>
	<a style="background-color:white;color:#6495ED;" href="listaviajes.php?p=1">Viajes</a>
<?php }else{ ?>
	<a href="listaviajes.php?p=1">Viajes</a>
<?php }if($p==2){ ?>
	<a style="background-color:white;color:#6495ED;" href="chofer.php?p=2">Choferes</a>
<?php }else{ ?>
	<a href="chofer.php?p=2">Choferes</a>
<?php }if($p==3){ ?>
	<a style="background-color:white;color:#6495ED;" href="veiculo.php?p=3">Vehículos</a>
<?php }else{ ?>
	<a href="veiculo.php?p=3">Vehículos</a>
<?php }if($p==4){ ?>
	<a style="background-color:white;color:#6495ED;" href="opciones.php?p=4">Usuarios</a>
<?php }else{ ?>
	<a href="opciones.php?p=4">Usuarios</a>
<?php } ?>
<a href="logout.php">Cerrar sessión</a>
</div>