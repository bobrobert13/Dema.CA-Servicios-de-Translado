<?php include("includes/session.php");
if(!isset($_GET["id"])){
	header("location: mainpage.php");
}else{
	$id = $_GET["id"];
}
$query1 = mysqli_query($link, "SELECT * FROM solicitud WHERE id='$id'");
$rows = mysqli_fetch_assoc($query1);
if(isset($_POST['viaje'])){
	require("includes/viaje.php");
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
<table style="margin-bottom:0px;">
	<tr>
		<td colspan="2"><b>PASAJERO: </b><?php echo $rows["nombrePasajero"]; ?></td>
	</tr>
	<tr>
		<td><b>CHOFER: </b>
		<?php 
		$choferVa = $rows["chofer"];
		$rowChofer = mysqli_query($link, "SELECT nombreCompleto FROM chofer WHERE cedula='$choferVa'");
		$rowsChofer = @mysqli_fetch_assoc($rowChofer);
		echo $rowsChofer['nombreCompleto'];
		?>
		</td>
		<td><b>FECHA: </b><?php $f=strtotime($rows["fechaChofer"]); echo date("d-m-Y", $f); ?></td>
	</tr>
	<tr>
		<td><b>VEHÍCULO: </b><?php echo  $rows["veiculo"]; ?></td>
		<td><b>HORA: </b><?php $d=strtotime($rows["horaVeiculo"]); echo date("h:i:sa", $d); ?></td>
	</tr>
	<tr>
		<td colspan="2"><b>DETALLES: </b><?php echo  $rows["detalles"]; ?></td>
	</tr>
</table>
<table style="border-top:none;margin-top:0px;">	
	<tr>
		<td style="text-align:center;border-top:none;" colspan="5"><b>TRASLADOS</td>
	</tr>
	<tr>
		<td>SALIDA</td>
		<td>HORA</td>
		<td>LLEGADA</td>
		<td>HORA</td>
		<td>PRECIO</td>
	</tr>
	<?php 
	$query2 = mysqli_query($link, "SELECT * FROM precios WHERE idTraslado='$id'");
	while($rows2 = @mysqli_fetch_assoc($query2)){
	?>
	<tr>
		<td><?php echo $rows2["salida"] ?></td>
		<td><?php $e=strtotime($rows2["horaSalida"]); echo date("h:i:sa", $e) ?></td>
		<td><?php echo $rows2["Llegada"] ?></td>
		<td><?php $f=strtotime($rows2["horaLlegada"]); echo date("h:i:sa", $f) ?></td>
		<td><?php echo $rows2["precio"] ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="4">MONTO TOTAL DE TRASLADOS</td>
		<td><?php 
		if($query6 = mysqli_query($link, "SELECT precio FROM precios WHERE idTraslado='$id'")){
			$precioTotal = 0;
			while($rows7 = @mysqli_fetch_assoc($query6)){
				$precioTotal += $rows7["precio"];
			}
		}else{
			$precioTotal = 0;
		}
		echo $precioTotal; 
		?></td>
	</tr>
	<tr>
		<td style="text-align:center;padding:5px;" colspan="5"><button style="margin: 0px;width:100%;background-color: #6495ED;color:white;" onclick="document.getElementById('id1').style.display='block'">Ingresar nuevo viaje</button></td>
	</tr>
	<tr>
		<td style="text-align:center;padding:5px;" colspan="5"><a href="imprimir.php?id=<?php echo $id; ?>"><button style="margin: 0px;width:100%;background-color: #6495ED;color:white;">Imprimir</button></a></td>
	</tr>
</table>
	<div id="id1" class="modal">
		<form class="modal-content animate" method="POST" action="">
			<div class="closecontainer">
				<span onclick="document.getElementById('id1').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Ingresar viaje</h3>
				<input type="hidden" name="idTraslado" value="<?php echo $id; ?>">
				<label><b>SALIDA</b></label>
				<input type="text" name="salida" maxlength="50" required pattern="{1,50}">
				<label><b>HORA</b></label>
				<input type="time" name="horaSalida" required>
				<label><b>LLEGADA</b></label>
				<input type="text" name="Llegada" maxlength="50" required pattern="{1,50}">
				<label><b>HORA</b></label>
				<input type="time" name="horaLlegada" required>
				<label><b>PRECIO</b></label>
				<input type="text" name="precio" required maxlength="12" pattern="[0-9]{1,12}">
				<input type="submit" value="Ingresar" name="viaje">
			</div>
		</form>
	</div>
</article>
</section>
<footer>
</footer>
</body>
</html>