<?php include("includes/session.php");
$id = $_GET["id"];
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php");?>
<link rel="stylesheet" type="text/css" href="css/modal.css">
<link rel="stylesheet" type="text/css" href="css/print.css">
<link rel="stylesheet" type="text/css" href="template/template.css">
<style>
	table{
		padding:0px;
	}
</style>
</head>
<body>
<header>
</header>
<section>
<article>
	<table style="border:none;">
		<tr>
			<th style="border:none;padding:0px;" class="sizehalf">
				<h1>TRANSPORTE Y SEVICIOS DEMA, C.A.</h1>
				<h1>(DEMACA)</h1>
				<p>Calle 17 Sur edif n°80 Piso PB Ofinica N° 1. Zona Pueblo Nuevo Sur</p>
				<p>Telf 0283 - 2414130 | 0414 - 3836340 | 0416 - 6530173 - El Tigre . Edo Anzoategui</p>
				<h4>RIF. J - 3 0 4 3 1 9 8 1 - 9</h4>
			</th>
			<th style="border:none;" class="sizehalf">
				<h1>SOLICITUD DE TAXI</h1>
			</th>
		</tr>
		<tr>
			<th colspan="2" style="border:none;padding:0px;" class="sizehalf">
				<p>(THIS DRIVER IS AN AUTHORIZED DEMACA CONTRACTOR PLEASE CONFIRM IDENTIFICATION BADGE)</p>
				<p>(ESTE CHOFER ESTA AUTORIZADO POR DEMACA, POR FAVOR COMFIRME QUE PORTE CARNET)</p>
			</th>
		</tr>
		<tr>
			<th style="border:none;padding:0px;" class="sizehalf">
				<h4>SERVICE ORDER / SOLICITUD DE TRASLADO</h4>
			</th>
			<th style="border:none;padding:0px;" class="sizehalf">
				<h3>N° 000001</h3>
			</th>
		</tr>
	</table>
	<table>
		<tr>
			<th style="text-align:center;border-top:none;" colspan="5"><b>TRASLADOS</th>
		</tr>
		<tr>
			<th>SALIDA</th>
			<th>HORA</th>
			<th>LLEGADA</th>
			<th>HORA</th>
			<th>PRECIO</th>
		</tr>
		<?php 
			$query2 = mysqli_query($link, "SELECT * FROM precios WHERE idTraslado='$id' LIMIT 7");
			$i=0;
			while($rows2 = mysqli_fetch_assoc($query2)){
			$i++;
		?>
		<tr>
			<td><?php echo @$rows2["salida"] ?></td>
			<td><?php echo @$rows2["horaSalida"] ?></td>
			<td><?php echo @$rows2["Llegada"] ?></td>
			<td><?php echo @$rows2["horaLlegada"] ?></td>
			<td><?php echo @$rows2["precio"] ?></td>
		</tr>
		<?php } ?>
		<tr>
		<th colspan="4">MONTO TOTAL DE TRASLADOS</td>
		<td>
			<?php 
				if($query6 = mysqli_query($link, "SELECT precio FROM viajes WHERE idTraslado='$id'")){
					$precioTotal = 0;
					while($rows7 = @mysqli_fetch_assoc($query6)){
						$precioTotal += $rows7["precio"];
					}
				}else{
					$precioTotal = 0;
				}
				echo $precioTotal; 
			?>
		</td>
	</tr>
	</table>
	<a href="solicitudtraslado.php?id=<?php echo $id; ?>"><button class="no-print">Volver</button></a>
	<button class="no-print" onclick="print()">Imprimir</button>
</article>
</section>
<footer>
</footer>
</body>
</html>