<?php include("includes/session.php");
if(!isset($_GET["id"])){
	header("location: chofer.php");
}else{
	$id = $_GET["id"];
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php");?>
<link rel="stylesheet" type="text/css" href="css/table.css">
<link rel="stylesheet" type="text/css" href="css/modal.css">
<link rel="stylesheet" type="text/css" href="template/template.css">
</head>
<body>
<header>
<?php include("includes/header.php");?>
</header>
<section>
<article>
<table>
<tr>
	<th colspan="7">Lista de viajes</th>
</tr>
<tr>
	<th>Vehículo</th>
	<th>Fecha</th>
	<th>Salida</th>
	<th>Hora</th>
	<th>Llegada</th>
	<th>Hora</th>
	<th>Precio</th>
</tr>
<?php 
$sql1 = mysqli_query($link, "SELECT * FROM solicitud WHERE chofer='$id' AND estado <> 'Eliminado'");
while($row1 = mysqli_fetch_assoc($sql1)){
	$idTraslado = $row1['id'];
	$sql2 = mysqli_query($link, "SELECT * FROM precios WHERE idTraslado='$idTraslado'");
	while($row2 = @mysqli_fetch_assoc($sql2)){
?>
<tr>
	<td><?php echo $row1["veiculo"]; ?></td>
	<td><?php $f=strtotime($row1["fechaChofer"]); echo date("d-m-yy", $f); ?></td>
	<td><?php echo $row2["salida"]; ?></td>
	<td><?php $f=strtotime($row2["horaSalida"]); echo date("h:i:sa", $f); ?></td>
	<td><?php echo $row2["Llegada"]; ?></td>
	<td><?php $f=strtotime($row2["horaLlegada"]); echo date("h:i:sa", $f); ?></td>
	<td><?php echo $row2["precio"]; ?></td>
</tr>
<?php 
	}
}	
?>
</table>
</article>
</section>
<footer>
</footer>
</body>
</html>