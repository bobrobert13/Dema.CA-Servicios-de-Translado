<?php include("includes/session.php");
if(isset($_POST['veiculo'])){
	require("includes/veiculo.php");
}
if(!isset($_GET["n"]) or $_GET["n"]<0 or !is_numeric($_GET["n"])){
	$n = 0;
}else{
	$n = $_GET["n"];
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
<p id="demo"></p>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por fecha...">
<table id="myTable">
	<tr>
		<th colspan="8">Lista de viajes</th>
	</tr>
	<tr>
		<th>Chofer</th>
		<th>Vehículo</th>
		<th>Fecha</th>
		<th>Salida</th>
		<th>Hora</th>
		<th>Llegada</th>
		<th>Hora</th>
		<th>Precio</th>
	</tr>
	<?php 
	$sql1 = mysqli_query($link, "SELECT * FROM solicitud WHERE estado <> 'Eliminado'");
	while($row1 = mysqli_fetch_assoc($sql1)){
		$idTraslado = $row1['id'];
		$sql2 = mysqli_query($link, "SELECT * FROM precios WHERE idTraslado='$idTraslado'");
		while($row2 = @mysqli_fetch_assoc($sql2)){
			$chofer = $row1["chofer"];
			$sql3 = mysqli_query($link, "SELECT * FROM chofer WHERE cedula='$chofer'");
			$row4 = mysqli_fetch_assoc($sql3);
	?>
		<tr>
			<td><?php echo $row4['nombreCompleto']; ?></td>
			<td><?php echo $row1["veiculo"]; ?></td>
			<td><?php $f=strtotime($row1["fechaChofer"]); echo date("d-m-Y", $f); ?></td>
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
<br>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
<script>
function myFunction() {
	var input1, filter1, input2, filter2, input3, filter3, table, tr, td, i, y;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");

	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[2];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		} 
	}
}
</script>
</html>